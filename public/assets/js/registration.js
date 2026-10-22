(function () {
  const cfg = window.GymRegistration;
  if (!cfg) return;

  const form = document.getElementById('gym-registration-form');
  const flash = document.getElementById('registration-flash');
  const btnPrev = document.getElementById('btn-prev');
  const btnNext = document.getElementById('btn-next');
  const btnDraft = document.getElementById('btn-draft');
  let currentStep = cfg.currentStep || 1;
  let busy = false;
  let hasGymLogo = !!cfg.hasGymLogo;
  let submitting = false;

  function showFlash(message, success) {
    if (!flash) return;
    flash.hidden = !message;
    flash.textContent = message || '';
    flash.classList.toggle('is-success', !!success);
  }

  function slugify(value) {
    return String(value || '')
      .toLowerCase()
      .trim()
      .replace(/[^a-z0-9\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-')
      .replace(/^-|-$/g, '');
  }

  function serializeStep(step) {
    const data = { step: step };
    const root = form.querySelector('.registration-step[data-step="' + step + '"]');
    if (!root) return data;

    root.querySelectorAll('input, select, textarea').forEach((el) => {
      if (!el.name || el.name === 'plan_radio' || el.name === 'confirm') return;
      if (el.type === 'checkbox') {
        if (!el.checked) return;
        if (!data[el.name]) data[el.name] = [];
        if (el.name.endsWith('[]')) {
          const key = el.name.slice(0, -2);
          if (!data[key]) data[key] = [];
          data[key].push(el.value);
        } else {
          data[el.name] = el.value;
        }
        return;
      }
      if (el.type === 'radio' && !el.checked) return;
      setNested(data, el.name, el.value);
    });

    if (step === 2) {
      data.external_plan_id = document.getElementById('external_plan_id').value;
      data.plan_name = document.getElementById('plan_name').value;
      data.billing_cycle = document.getElementById('billing_cycle').value;
    }

    return data;
  }

  function setNested(obj, path, value) {
    const parts = path.replace(/\]/g, '').split('[');
    let cursor = obj;
    for (let i = 0; i < parts.length - 1; i++) {
      const key = parts[i];
      if (!cursor[key] || typeof cursor[key] !== 'object') cursor[key] = {};
      cursor = cursor[key];
    }
    cursor[parts[parts.length - 1]] = value;
  }

  async function api(url, options) {
    const headers = Object.assign({
      'Accept': 'application/json',
      'X-CSRF-TOKEN': cfg.csrf,
      'X-Requested-With': 'XMLHttpRequest',
    }, options.headers || {});

    if (!(options.body instanceof FormData)) {
      headers['Content-Type'] = 'application/json';
      options.body = JSON.stringify(options.body || {});
    }

    const response = await fetch(url, Object.assign({ credentials: 'same-origin' }, options, { headers }));
    let json = {};
    try { json = await response.json(); } catch (e) {}
    return { response, json };
  }

  async function ensureDraft() {
    const body = {
      external_plan_id: document.getElementById('external_plan_id').value || null,
      plan_name: document.getElementById('plan_name').value || null,
      billing_cycle: document.getElementById('billing_cycle').value || 'monthly',
    };
    const { response, json } = await api(cfg.routes.start, { method: 'POST', body });
    if (!response.ok || !json.success) {
      throw new Error(json.message || cfg.i18n.networkError);
    }
    return json;
  }

  function validateLocal(step) {
    const root = form.querySelector('.registration-step[data-step="' + step + '"]');
    if (!root) return true;
    const required = root.querySelectorAll('[required]');
    for (const el of required) {
      if (el.type === 'file') continue;
      if (el.type === 'checkbox' && !el.checked) {
        el.focus();
        return false;
      }
      if (!el.value) {
        el.reportValidity();
        return false;
      }
    }
    if (step === 1) {
      const password = document.getElementById('owner_password');
      const confirm = document.getElementById('owner_password_confirmation');
      if (password && confirm && (password.value || confirm.value || password.required)) {
        if (password.value.length < 8) {
          showFlash(cfg.i18n.passwordMin || 'Password must be at least 8 characters.', false);
          password.focus();
          return false;
        }
        if (password.value !== confirm.value) {
          showFlash(cfg.i18n.passwordMismatch || 'Passwords do not match.', false);
          confirm.focus();
          return false;
        }
      }
    }
    if (step === 2) {
      if (!document.getElementById('external_plan_id').value) {
        showFlash('Please select a plan.', false);
        return false;
      }
    }
    if (step === 3 && !hasGymLogo) {
      showFlash(cfg.i18n.gymLogoRequired || 'Please upload the gym logo.', false);
      return false;
    }
    return true;
  }

  function renderStep() {
    form.querySelectorAll('.registration-step').forEach((el) => {
      el.hidden = Number(el.dataset.step) !== currentStep;
    });
    document.querySelectorAll('.progress-step').forEach((btn) => {
      const n = Number(btn.dataset.goto);
      btn.classList.toggle('is-active', n === currentStep);
      btn.classList.toggle('is-done', n < currentStep);
      btn.disabled = n > currentStep;
    });
    btnPrev.hidden = currentStep <= 1;
    btnNext.textContent = currentStep >= 5 ? cfg.i18n.submit : cfg.i18n.next;
  }

  function updatePlanPrices() {
    const billing = document.getElementById('billing_cycle').value;
    document.querySelectorAll('.plan-card input[type="radio"]').forEach((input) => {
      const priceEl = input.closest('.plan-card').querySelector('.plan-price');
      if (!priceEl) return;
      const amount = billing === 'yearly' ? input.dataset.yearly : input.dataset.monthly;
      priceEl.textContent = (input.dataset.currency || 'EGP') + Number(amount).toLocaleString();
    });
  }

  async function saveDraft() {
    if (busy) return;
    busy = true;
    showFlash('', false);
    try {
      await ensureDraft();
      const payload = Object.assign({}, serializeStep(currentStep), { current_step: currentStep });
      delete payload.step;
      const { response, json } = await api(cfg.routes.draft, { method: 'POST', body: payload });
      if (!response.ok || !json.success) throw new Error(json.message || cfg.i18n.networkError);
      showFlash(cfg.i18n.draftSaved, true);
    } catch (e) {
      showFlash(e.message || cfg.i18n.networkError, false);
    } finally {
      busy = false;
    }
  }

  async function goNext() {
    if (busy || submitting) return;
    if (!validateLocal(currentStep)) return;

    busy = true;
    btnNext.disabled = true;
    showFlash('', false);

    try {
      await ensureDraft();

      if (currentStep < 5) {
        const payload = serializeStep(currentStep);
        const { response, json } = await api(cfg.routes.step, { method: 'POST', body: payload });
        if (!response.ok || !json.success) {
          const firstError = json.errors ? Object.values(json.errors).flat()[0] : null;
          throw new Error(firstError || json.message || cfg.i18n.networkError);
        }
        currentStep = Math.min(5, (json.next_step || currentStep + 1));
        renderStep();
      } else {
        submitting = true;
        btnNext.textContent = cfg.i18n.submitting;
        const payload = serializeStep(5);
        payload.confirm = 1;
        delete payload.step;
        const { response, json } = await api(cfg.routes.submit, { method: 'POST', body: payload });
        if (!response.ok || !json.success) {
          const firstError = json.errors ? Object.values(json.errors).flat()[0] : null;
          throw new Error(firstError || json.message || cfg.i18n.networkError);
        }
        window.location.href = json.redirect || ('/' + cfg.locale + '/register/success');
        return;
      }
    } catch (e) {
      showFlash(e.message || cfg.i18n.networkError, false);
      submitting = false;
    } finally {
      busy = false;
      btnNext.disabled = false;
      if (!submitting) renderStep();
    }
  }

  form.querySelector('#gym_name_en')?.addEventListener('input', function () {
    const slug = slugify(this.value);
    const slugField = document.getElementById('slug_field');
    if (slugField) slugField.value = slug;
  });

  document.querySelectorAll('.billing-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
      document.getElementById('billing_cycle').value = btn.dataset.billing;
      document.querySelectorAll('.billing-btn').forEach((b) => b.classList.toggle('is-active', b === btn));
      updatePlanPrices();
    });
  });

  document.querySelectorAll('.plan-card input[type="radio"]').forEach((input) => {
    input.addEventListener('change', () => {
      document.getElementById('external_plan_id').value = input.value;
      document.getElementById('plan_name').value = input.dataset.planName || '';
    });
  });

  const checkedPlan = document.querySelector('.plan-card input[type="radio"]:checked');
  if (checkedPlan) {
    document.getElementById('external_plan_id').value = checkedPlan.value;
    document.getElementById('plan_name').value = checkedPlan.dataset.planName || '';
  }

  function setMediaStatus(type, text, visible) {
    const status = document.querySelector('[data-media-status="' + type + '"]');
    if (!status) return;
    status.hidden = !visible;
    status.textContent = text || '';
  }

  function showMediaPreview(type, url) {
    const card = document.querySelector('[data-media-card="' + type + '"]');
    const preview = document.getElementById('preview-' + type);
    const empty = card ? card.querySelector('.media-dropzone-empty') : null;
    const replaceBtn = document.querySelector('[data-media-replace="' + type + '"]');
    if (!preview) return;

    if (url) {
      preview.innerHTML = '<img src="' + url + '" alt="">';
      preview.hidden = false;
      if (empty) empty.hidden = true;
      if (card) card.classList.add('has-file');
      if (replaceBtn) replaceBtn.hidden = false;
      setMediaStatus(type, cfg.i18n.mediaUploaded || 'Uploaded', true);
    }
  }

  async function uploadMediaFile(input, file) {
    if (!file) return;
    const type = input.dataset.mediaType;
    const card = document.querySelector('[data-media-card="' + type + '"]');
    busy = true;
    if (card) card.classList.add('is-uploading');
    setMediaStatus(type, cfg.i18n.mediaUploading || 'Uploading…', true);
    showFlash('', false);

    try {
      await ensureDraft();
      const fd = new FormData();
      fd.append('file', file);
      fd.append('type', type);
      const { response, json } = await api(cfg.routes.upload, { method: 'POST', body: fd });
      if (!response.ok || !json.success) {
        const firstError = json.errors ? Object.values(json.errors).flat()[0] : null;
        throw new Error(firstError || json.message || cfg.i18n.uploadFailed);
      }
      if (type === 'gym_logo') hasGymLogo = true;
      const url = json.url
        || (json.data && json.data.media && json.data.media[type] && json.data.media[type].url)
        || URL.createObjectURL(file);
      showMediaPreview(type, url);
    } catch (e) {
      showFlash(e.message || cfg.i18n.uploadFailed, false);
      input.value = '';
      setMediaStatus(type, '', false);
    } finally {
      if (card) card.classList.remove('is-uploading');
      busy = false;
    }
  }

  form.querySelectorAll('input[type="file"][data-media-type]').forEach((input) => {
    const dropzone = input.closest('.media-dropzone');

    input.addEventListener('change', () => {
      if (!input.files || !input.files[0]) return;
      uploadMediaFile(input, input.files[0]);
    });

    if (dropzone) {
      ['dragenter', 'dragover'].forEach((eventName) => {
        dropzone.addEventListener(eventName, (e) => {
          e.preventDefault();
          dropzone.classList.add('is-dragging');
        });
      });
      ['dragleave', 'drop'].forEach((eventName) => {
        dropzone.addEventListener(eventName, (e) => {
          e.preventDefault();
          dropzone.classList.remove('is-dragging');
        });
      });
      dropzone.addEventListener('drop', (e) => {
        const file = e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files[0];
        if (!file) return;
        uploadMediaFile(input, file);
      });
    }
  });

  document.querySelectorAll('[data-media-replace]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const input = document.getElementById('media-input-' + btn.dataset.mediaReplace);
      if (input) input.click();
    });
  });

  document.querySelectorAll('.progress-step').forEach((btn) => {
    btn.addEventListener('click', () => {
      const target = Number(btn.dataset.goto);
      if (target < currentStep) {
        currentStep = target;
        renderStep();
      }
    });
  });

  btnPrev?.addEventListener('click', () => {
    if (currentStep > 1) {
      currentStep -= 1;
      renderStep();
    }
  });
  btnNext?.addEventListener('click', goNext);
  btnDraft?.addEventListener('click', saveDraft);

  document.querySelectorAll('.password-toggle').forEach((btn) => {
    btn.addEventListener('click', () => {
      const input = document.getElementById(btn.dataset.target);
      const icon = btn.querySelector('i');
      if (!input || !icon) return;

      const showing = input.type === 'text';
      input.type = showing ? 'password' : 'text';
      icon.classList.toggle('bi-eye', showing);
      icon.classList.toggle('bi-eye-slash', !showing);
      btn.setAttribute('aria-label', showing ? (cfg.i18n.showPassword || 'Show password') : (cfg.i18n.hidePassword || 'Hide password'));
    });
  });

  updatePlanPrices();
  renderStep();
})();
