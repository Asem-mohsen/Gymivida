(function () {
  const cfg = window.GymRegistration;
  if (!cfg) return;

  const form = document.getElementById('gym-registration-form');
  const btnPrev = document.getElementById('btn-prev');
  const btnNext = document.getElementById('btn-next');
  const btnDraft = document.getElementById('btn-draft');
  let currentStep = cfg.currentStep || 1;
  let busy = false;
  let hasGymLogo = !!cfg.hasGymLogo;
  let submitting = false;

  function toastSuccess(message) {
    if (typeof toastr !== 'undefined') {
      toastr.success(message, cfg.i18n.successTitle || '');
    }
  }

  function toastError(message) {
    if (typeof toastr !== 'undefined') {
      toastr.error(message || cfg.i18n.networkError, cfg.i18n.errorTitle || '');
    }
  }

  function toastValidation(message) {
    if (typeof toastr !== 'undefined') {
      toastr.error(
        message || cfg.i18n.checkFormErrors,
        cfg.i18n.validationTitle || cfg.i18n.errorTitle || ''
      );
    }
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

  function toBracketName(field) {
    if (!field.includes('.')) return field;
    return field.split('.').reduce(function (acc, part, index) {
      return index === 0 ? part : acc + '[' + part + ']';
    }, '');
  }

  function findField(field) {
    const bracketName = toBracketName(field);
    const byName = form.querySelector('[name="' + bracketName + '"]');
    if (byName) return byName;

    return document.getElementById(field)
      || document.getElementById(field + '_field')
      || form.querySelector('[name="' + field + '"]');
  }

  function ensureErrorElement(input) {
    const host = input.closest('label') || input.parentElement;
    if (!host) return null;

    let errorEl = host.querySelector(':scope > .field-error');
    if (!errorEl) {
      errorEl = document.createElement('span');
      errorEl.className = 'field-error';
      errorEl.setAttribute('role', 'alert');
      host.appendChild(errorEl);
    }
    return errorEl;
  }

  function clearFieldErrors() {
    form.querySelectorAll('.field-error').forEach(function (el) {
      el.textContent = '';
    });
    form.querySelectorAll('.is-invalid').forEach(function (el) {
      el.classList.remove('is-invalid');
    });
  }

  function displayFieldErrors(errors) {
    clearFieldErrors();
    if (!errors || typeof errors !== 'object') return null;

    let firstInput = null;

    Object.keys(errors).forEach(function (field) {
      const messages = errors[field];
      const message = Array.isArray(messages) ? messages[0] : messages;
      if (!message) return;

      const input = findField(field);
      if (!input) return;

      input.classList.add('is-invalid');
      const errorEl = ensureErrorElement(input);
      if (errorEl) errorEl.textContent = message;
      if (!firstInput) firstInput = input;
    });

    return firstInput;
  }

  function focusFieldError(input) {
    if (!input) return;
    const stepRoot = input.closest('.registration-step');
    if (stepRoot && stepRoot.dataset.step) {
      const step = Number(stepRoot.dataset.step);
      if (step && step !== currentStep) {
        currentStep = step;
        renderStep();
      }
    }
    input.focus({ preventScroll: false });
    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  function handleApiFailure(json) {
    const errors = json && json.errors ? json.errors : null;
    const hasFieldErrors = errors && Object.keys(errors).length > 0;
    const firstError = hasFieldErrors ? Object.values(errors).flat()[0] : null;
    const message = firstError || (json && json.message) || cfg.i18n.networkError;

    if (hasFieldErrors) {
      const firstInput = displayFieldErrors(errors);
      toastValidation(message);
      focusFieldError(firstInput);
    } else {
      clearFieldErrors();
      toastError(message);
    }

    return message;
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

  function showLocalFieldError(input, message) {
    clearFieldErrors();
    if (input) {
      input.classList.add('is-invalid');
      const errorEl = ensureErrorElement(input);
      if (errorEl) errorEl.textContent = message;
      focusFieldError(input);
    }
    toastValidation(message);
  }

  function validateLocal(step) {
    const root = form.querySelector('.registration-step[data-step="' + step + '"]');
    if (!root) return true;
    const required = root.querySelectorAll('[required]');
    for (const el of required) {
      if (el.type === 'file') continue;
      if (el.type === 'checkbox' && !el.checked) {
        showLocalFieldError(el, cfg.i18n.requiredField || cfg.i18n.checkFormErrors);
        return false;
      }
      if (!el.value) {
        showLocalFieldError(el, cfg.i18n.requiredField || cfg.i18n.checkFormErrors);
        return false;
      }
    }
    if (step === 1) {
      const password = document.getElementById('owner_password');
      const confirm = document.getElementById('owner_password_confirmation');
      if (password && confirm && (password.value || confirm.value || password.required)) {
        if (password.value.length < 8) {
          showLocalFieldError(password, cfg.i18n.passwordMin || 'Password must be at least 8 characters.');
          return false;
        }
        if (password.value !== confirm.value) {
          showLocalFieldError(confirm, cfg.i18n.passwordMismatch || 'Passwords do not match.');
          return false;
        }
      }
    }
    if (step === 2) {
      if (!document.getElementById('external_plan_id').value) {
        const planInput = form.querySelector('.plan-card input[type="radio"]');
        showLocalFieldError(planInput, cfg.i18n.selectPlanRequired || 'Please select a plan.');
        return false;
      }
    }
    if (step === 3 && !hasGymLogo) {
      const logoInput = document.getElementById('media-input-gym_logo');
      showLocalFieldError(logoInput, cfg.i18n.gymLogoRequired || 'Please upload the gym logo.');
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
    clearFieldErrors();
    try {
      await ensureDraft();
      const payload = Object.assign({}, serializeStep(currentStep), { current_step: currentStep });
      delete payload.step;
      const { response, json } = await api(cfg.routes.draft, { method: 'POST', body: payload });
      if (!response.ok || !json.success) {
        handleApiFailure(json);
        return;
      }
      toastSuccess(cfg.i18n.draftSaved);
    } catch (e) {
      toastError(e.message || cfg.i18n.networkError);
    } finally {
      busy = false;
    }
  }

  async function goNext() {
    if (busy || submitting) return;
    if (!validateLocal(currentStep)) return;

    busy = true;
    btnNext.disabled = true;
    clearFieldErrors();

    try {
      await ensureDraft();

      if (currentStep < 5) {
        const payload = serializeStep(currentStep);
        const { response, json } = await api(cfg.routes.step, { method: 'POST', body: payload });
        if (!response.ok || !json.success) {
          handleApiFailure(json);
          return;
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
          handleApiFailure(json);
          submitting = false;
          return;
        }
        window.location.href = json.redirect || ('/' + cfg.locale + '/register/success');
        return;
      }
    } catch (e) {
      toastError(e.message || cfg.i18n.networkError);
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
    clearFieldErrors();

    try {
      await ensureDraft();
      const fd = new FormData();
      fd.append('file', file);
      fd.append('type', type);
      const { response, json } = await api(cfg.routes.upload, { method: 'POST', body: fd });
      if (!response.ok || !json.success) {
        handleApiFailure(json);
        input.value = '';
        setMediaStatus(type, '', false);
        return;
      }
      if (type === 'gym_logo') hasGymLogo = true;
      const url = json.url
        || (json.data && json.data.media && json.data.media[type] && json.data.media[type].url)
        || URL.createObjectURL(file);
      showMediaPreview(type, url);
    } catch (e) {
      toastError(e.message || cfg.i18n.uploadFailed);
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

  form.querySelectorAll('input, select, textarea').forEach((input) => {
    const clear = function () {
      this.classList.remove('is-invalid');
      const host = this.closest('label') || this.parentElement;
      const errorEl = host ? host.querySelector(':scope > .field-error') : null;
      if (errorEl) errorEl.textContent = '';
    };
    input.addEventListener('input', clear);
    input.addEventListener('change', clear);
  });

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
