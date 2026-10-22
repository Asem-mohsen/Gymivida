@extends('layout.master')

@section('title', __('registration.page_title') . ' — Gymivida')

@section('body-class', 'registration-page-body')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/registration.css') }}?v={{ filemtime(public_path('assets/css/registration.css')) }}">
@endpush

@section('content')
@php
  $r = $registration ?? [];
  $currentStep = (int) ($r['current_step'] ?? 1);
  if ($currentStep < 1) $currentStep = 1;
  if ($currentStep > 5) $currentStep = 5;
@endphp

<div class="page-title">
  <div class="breadcrumbs">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home', ['locale' => $locale]) }}"><i class="bi bi-house"></i> {{ __('nav.home') }}</a></li>
        <li class="breadcrumb-item active current">{{ __('registration.page_title') }}</li>
      </ol>
    </nav>
  </div>
  <div class="title-wrapper">
    <h1>{{ __('registration.page_title') }}</h1>
    <p>{{ __('registration.subtitle') }}</p>
  </div>
</div>

<section class="registration-page section light-background">
  <div class="container registration-shell">
    @if($bootstrapError)
      <div class="registration-alert" role="alert">{{ $bootstrapError }}</div>
    @endif

    <div id="registration-flash" class="registration-alert" hidden></div>

    <div class="registration-progress" role="navigation" aria-label="{{ __('registration.progress', ['current' => $currentStep, 'total' => 5]) }}">
      @foreach([1 => 'step_owner', 2 => 'step_gym', 3 => 'step_media', 4 => 'step_social', 5 => 'step_more'] as $num => $label)
        <button type="button" class="progress-step {{ $currentStep === $num ? 'is-active' : '' }} {{ $currentStep > $num ? 'is-done' : '' }}" data-goto="{{ $num }}" {{ $currentStep >= $num ? '' : 'disabled' }}>
          <span class="progress-index">{{ $num }}</span>
          <span class="progress-label">{{ __('registration.'.$label) }}</span>
        </button>
      @endforeach
    </div>

    <form id="gym-registration-form" class="registration-form" novalidate>
      <input type="hidden" name="billing_cycle" id="billing_cycle" value="{{ $billingCycle }}">
      <input type="hidden" name="plan_name" id="plan_name" value="{{ $r['plan_name'] ?? '' }}">
      <input type="hidden" name="external_plan_id" id="external_plan_id" value="{{ $selectedPlanId ?? ($r['external_plan_id'] ?? '') }}">

      {{-- Step 1 --}}
      <fieldset class="registration-step" data-step="1" @if($currentStep !== 1) hidden @endif>
        <legend>{{ __('registration.step_owner') }}</legend>
        <div class="field-grid">
          <label>{{ __('registration.owner_name') }} *
            <input type="text" name="owner_name" value="{{ $r['owner_name'] ?? '' }}" required maxlength="255">
          </label>
          <label>{{ __('registration.owner_email') }} *
            <input type="email" name="owner_email" value="{{ $r['owner_email'] ?? '' }}" required>
          </label>
          <label>{{ __('registration.owner_phone') }} *
            <input type="tel" name="owner_phone" value="{{ $r['owner_phone'] ?? '' }}" required>
          </label>
          <label>{{ __('registration.owner_gender') }} *
            <select name="owner_gender" required>
              <option value="">—</option>
              <option value="male" @selected(($r['owner_gender'] ?? '') === 'male')>{{ __('registration.male') }}</option>
              <option value="female" @selected(($r['owner_gender'] ?? '') === 'female')>{{ __('registration.female') }}</option>
            </select>
          </label>
          <label>{{ __('registration.password') }}{{ empty($r['has_password']) ? ' *' : '' }}
            <span class="password-field">
              <input type="password" name="owner_password" id="owner_password" autocomplete="new-password" minlength="8" @if(empty($r['has_password'])) required @endif>
              <button type="button" class="password-toggle" data-target="owner_password" aria-label="{{ __('registration.show_password') }}">
                <i class="bi bi-eye" aria-hidden="true"></i>
              </button>
            </span>
            @if(!empty($r['has_password']))
              <small>{{ __('registration.password_already_set') }}</small>
            @else
              <small>{{ __('registration.password_help') }}</small>
            @endif
          </label>
          <label>{{ __('registration.confirm_password') }}{{ empty($r['has_password']) ? ' *' : '' }}
            <span class="password-field">
              <input type="password" name="owner_password_confirmation" id="owner_password_confirmation" autocomplete="new-password" minlength="8" @if(empty($r['has_password'])) required @endif>
              <button type="button" class="password-toggle" data-target="owner_password_confirmation" aria-label="{{ __('registration.show_password') }}">
                <i class="bi bi-eye" aria-hidden="true"></i>
              </button>
            </span>
          </label>
        </div>
      </fieldset>

      {{-- Step 2 --}}
      <fieldset class="registration-step" data-step="2" @if($currentStep !== 2) hidden @endif>
        <legend>{{ __('registration.step_gym') }}</legend>
        <div class="field-grid">
          <label>{{ __('registration.gym_name_en') }} *
            <input type="text" name="gym_name[en]" id="gym_name_en" value="{{ $r['gym_name']['en'] ?? '' }}" required>
          </label>
          <label>{{ __('registration.gym_name_ar') }}
            <input type="text" name="gym_name[ar]" value="{{ $r['gym_name']['ar'] ?? '' }}" dir="rtl">
          </label>
          <label>{{ __('registration.slug') }}
            <input type="text" name="slug" id="slug_field" value="{{ $r['slug'] ?? '' }}" readonly>
            <small>{{ __('registration.slug_help') }}</small>
          </label>
          <label>{{ __('registration.size') }} *
            <select name="size" required>
              <option value="">—</option>
              @foreach(['1-10','10-50','50-100','100-1000'] as $size)
                <option value="{{ $size }}" @selected(($r['size'] ?? '') === $size)>{{ $size }}</option>
              @endforeach
            </select>
          </label>
          <label>{{ __('registration.city') }} *
            <input type="text" name="city" value="{{ $r['city'] ?? 'Cairo' }}" required>
          </label>
          <label>{{ __('registration.country') }} *
            <input type="text" name="country" value="{{ $r['country'] ?? 'Egypt' }}" required>
          </label>
          <label>{{ __('registration.contact_email') }} *
            <input type="email" name="contact_email" value="{{ $r['contact_email'] ?? '' }}" required>
          </label>
          <label>{{ __('registration.phone') }} *
            <input type="tel" name="phone" value="{{ $r['phone'] ?? '' }}" required>
          </label>
        </div>
        <label class="full">{{ __('registration.address_en') }} *
          <textarea name="address[en]" rows="2" required>{{ $r['address']['en'] ?? '' }}</textarea>
        </label>
        <label class="full">{{ __('registration.address_ar') }}
          <textarea name="address[ar]" rows="2" dir="rtl">{{ $r['address']['ar'] ?? '' }}</textarea>
        </label>
        <label class="full">{{ __('registration.description_en') }}
          <textarea name="description[en]" rows="3">{{ $r['description']['en'] ?? '' }}</textarea>
        </label>
        <label class="full">{{ __('registration.description_ar') }}
          <textarea name="description[ar]" rows="3" dir="rtl">{{ $r['description']['ar'] ?? '' }}</textarea>
        </label>

        <div class="billing-toggle" role="group" aria-label="{{ __('registration.billing_cycle') }}">
          <button type="button" class="billing-btn {{ $billingCycle === 'monthly' ? 'is-active' : '' }}" data-billing="monthly">{{ __('registration.monthly') }}</button>
          <button type="button" class="billing-btn {{ $billingCycle === 'yearly' ? 'is-active' : '' }}" data-billing="yearly">{{ __('registration.yearly') }}</button>
        </div>

        <div class="plan-grid" role="radiogroup" aria-label="{{ __('registration.select_plan') }}">
          @foreach($products as $product)
            <label class="plan-card">
              <input type="radio" name="plan_radio" value="{{ $product['id'] }}"
                data-plan-name="{{ $product['name_en'] }}"
                data-monthly="{{ $product['monthly_price'] }}"
                data-yearly="{{ $product['yearly_price'] }}"
                data-currency="{{ $product['currency'] }}"
                @checked((string)($selectedPlanId ?? '') === (string)$product['id'])>
              <span class="plan-card-body">
                <strong>{{ $product['name'] }}</strong>
                <span class="plan-price" data-plan-id="{{ $product['id'] }}">
                  {{ $product['currency'] }}{{ number_format($billingCycle === 'yearly' ? $product['yearly_price'] : $product['monthly_price'], 0) }}
                </span>
              </span>
            </label>
          @endforeach
        </div>
      </fieldset>

      {{-- Step 3 --}}
      <fieldset class="registration-step" data-step="3" @if($currentStep !== 3) hidden @endif>
        <legend>{{ __('registration.step_media') }}</legend>
        <div class="media-grid">
          @foreach([
            'gym_logo' => true,
            'email_logo' => false,
            'footer_logo' => false,
            'favicon' => false,
          ] as $type => $required)
            @php $hasPreview = !empty($r['media'][$type]['url']); @endphp
            <div class="media-card {{ $hasPreview ? 'has-file' : '' }}" data-media-card="{{ $type }}">
              <div class="media-card-head">
                <div>
                  <strong>{{ __('registration.'.$type) }}</strong>
                  <span class="media-badge {{ $required ? 'is-required' : 'is-optional' }}">
                    {{ $required ? __('registration.required') : __('registration.optional') }}
                  </span>
                </div>
                <p>{{ __('registration.'.$type.'_hint') }}</p>
              </div>
              <label class="media-dropzone" for="media-input-{{ $type }}">
                <input
                  id="media-input-{{ $type }}"
                  type="file"
                  accept="image/jpeg,image/png,image/webp,image/gif"
                  data-media-type="{{ $type }}"
                >
                <div class="media-dropzone-empty" @if($hasPreview) hidden @endif>
                  <i class="bi bi-cloud-arrow-up" aria-hidden="true"></i>
                  <span class="media-drop-title">{{ __('registration.media_drop_title') }}</span>
                  <span class="media-drop-hint">{{ __('registration.media_drop_hint') }}</span>
                </div>
                <div class="media-preview" id="preview-{{ $type }}" @if(!$hasPreview) hidden @endif>
                  @if($hasPreview)
                    <img src="{{ $r['media'][$type]['url'] }}" alt="{{ $type }}">
                  @endif
                </div>
                <span class="media-status" data-media-status="{{ $type }}" hidden></span>
              </label>
              <button type="button" class="media-replace-btn" data-media-replace="{{ $type }}" @if(!$hasPreview) hidden @endif>
                {{ __('registration.media_replace') }}
              </button>
            </div>
          @endforeach
        </div>
      </fieldset>

      {{-- Step 4 --}}
      <fieldset class="registration-step" data-step="4" @if($currentStep !== 4) hidden @endif>
        <legend>{{ __('registration.step_social') }}</legend>
        <div class="field-grid">
          <label>{{ __('registration.facebook_url') }}
            <input type="url" name="facebook_url" value="{{ $r['facebook_url'] ?? '' }}" placeholder="https://">
          </label>
          <label>{{ __('registration.instagram_url') }}
            <input type="url" name="instagram_url" value="{{ $r['instagram_url'] ?? '' }}" placeholder="https://">
          </label>
          <label>{{ __('registration.x_url') }}
            <input type="url" name="x_url" value="{{ $r['x_url'] ?? '' }}" placeholder="https://">
          </label>
        </div>
      </fieldset>

      {{-- Step 5 --}}
      <fieldset class="registration-step" data-step="5" @if($currentStep !== 5) hidden @endif>
        <legend>{{ __('registration.step_more') }}</legend>
        <label class="full">{{ __('registration.gym_type') }}
          <select name="gym_type">
            <option value="">—</option>
            @foreach(['mixed','ladies_only','men_only'] as $type)
              <option value="{{ $type }}" @selected(($r['gym_type'] ?? '') === $type)>{{ __('registration.'.$type) }}</option>
            @endforeach
          </select>
        </label>

        <fieldset class="option-panel">
          <legend>{{ __('registration.target_audience') }}</legend>
          <p class="option-panel-hint">{{ __('registration.target_audience_hint') }}</p>
          <div class="option-grid option-grid--audience">
            @foreach([
              'youth' => 'bi-emoji-smile',
              'professionals' => 'bi-briefcase',
              'luxury' => 'bi-gem',
              'families' => 'bi-people',
              'seniors' => 'bi-heart-pulse',
              'athletes' => 'bi-trophy',
              'beginners' => 'bi-flag',
              'general' => 'bi-globe2',
            ] as $audience => $icon)
              <label class="option-tile">
                <input type="checkbox" name="target_audience[]" value="{{ $audience }}" @checked(in_array($audience, $r['target_audience'] ?? [], true))>
                <span class="option-tile-face">
                  <span class="option-tile-check" aria-hidden="true"><i class="bi bi-check-lg"></i></span>
                  <i class="bi {{ $icon }} option-tile-icon" aria-hidden="true"></i>
                  <span class="option-tile-label">{{ __('registration.audience_'.$audience) }}</span>
                </span>
              </label>
            @endforeach
          </div>
        </fieldset>

        <fieldset class="option-panel">
          <legend>{{ __('registration.amenities') }}</legend>
          <p class="option-panel-hint">{{ __('registration.amenities_hint') }}</p>
          <div class="option-grid option-grid--amenities">
            @foreach([
              'personal_training' => 'bi-person-arms-up',
              'group_classes' => 'bi-people-fill',
              'pool' => 'bi-water',
              'sauna' => 'bi-thermometer-sun',
              'spa' => 'bi-flower1',
              'cafe' => 'bi-cup-hot',
              'parking' => 'bi-p-circle',
              'childcare' => 'bi-balloon',
              'lockers' => 'bi-safe',
              'wifi' => 'bi-wifi',
              'twentyfour_seven' => 'bi-clock-history',
              'crossfit' => 'bi-lightning-charge',
            ] as $amenity => $icon)
              <label class="option-tile">
                <input type="checkbox" name="amenities[]" value="{{ $amenity }}" @checked(in_array($amenity, $r['amenities'] ?? [], true))>
                <span class="option-tile-face">
                  <span class="option-tile-check" aria-hidden="true"><i class="bi bi-check-lg"></i></span>
                  <i class="bi {{ $icon }} option-tile-icon" aria-hidden="true"></i>
                  <span class="option-tile-label">{{ __('registration.amenity_'.$amenity) }}</span>
                </span>
              </label>
            @endforeach
          </div>
        </fieldset>

        <label class="full">{{ __('registration.additional_info') }}
          <textarea name="additional_info" rows="4" maxlength="1000">{{ $r['additional_info'] ?? '' }}</textarea>
        </label>

        <div class="review-box">
          <h2>{{ __('registration.review_title') }}</h2>
          <p>{{ __('registration.review_hint') }}</p>
          <label class="confirm-row">
            <input type="checkbox" name="confirm" value="1" required>
            <span>{{ __('registration.confirm_submit') }}</span>
          </label>
        </div>
      </fieldset>

      <div class="registration-actions">
        <button type="button" class="btn-secondary" id="btn-prev" @if($currentStep <= 1) hidden @endif>{{ __('registration.previous') }}</button>
        <button type="button" class="btn-ghost" id="btn-draft">{{ __('registration.save_draft') }}</button>
        <button type="button" class="btn-primary" id="btn-next">{{ $currentStep >= 5 ? __('registration.submit') : __('registration.next') }}</button>
      </div>
    </form>
  </div>
</section>
@endsection

@push('scripts')
<script>
window.GymRegistration = {
  locale: @json($locale),
  currentStep: {{ $currentStep }},
  hasGymLogo: @json(!empty($r['media']['gym_logo']['url'])),
  routes: {
    start: @json(url('/api/v1/registration/start')),
    draft: @json(url('/api/v1/registration/draft')),
    step: @json(url('/api/v1/registration/step')),
    upload: @json(url('/api/v1/registration/upload')),
    submit: @json(url('/api/v1/registration/submit')),
  },
  csrf: @json(csrf_token()),
  i18n: {
    draftSaved: @json(__('registration.draft_saved')),
    networkError: @json(__('registration.network_error')),
    uploadFailed: @json(__('registration.upload_failed')),
    submitting: @json(__('registration.submitting')),
    next: @json(__('registration.next')),
    submit: @json(__('registration.submit')),
    passwordMin: @json(__('registration.password_min')),
    passwordMismatch: @json(__('registration.password_mismatch')),
    showPassword: @json(__('registration.show_password')),
    hidePassword: @json(__('registration.hide_password')),
    mediaUploading: @json(__('registration.media_uploading')),
    mediaUploaded: @json(__('registration.media_uploaded')),
    gymLogoRequired: @json(__('registration.gym_logo_required')),
  }
};
</script>
<script src="{{ asset('assets/js/registration.js') }}?v={{ filemtime(public_path('assets/js/registration.js')) }}" defer></script>
@endpush
