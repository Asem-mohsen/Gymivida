@extends('layout.master')

@section('title', __('privacy.title'))

@section('body-class', 'privacy-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="breadcrumbs">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home', ['locale' => $currentLocale]) }}"><i class="bi bi-house"></i> {{ __('nav.home') }}</a></li>
            <li class="breadcrumb-item active current">{{ __('privacy.breadcrumb') }}</li>
          </ol>
        </nav>
      </div>

      <div class="title-wrapper">
        <h1>{{ __('privacy.title') }}</h1>
        <p>{{ __('privacy.intro') }}</p>
      </div>
    </div><!-- End Page Title -->

    <!-- Privacy Section -->
    <section id="privacy" class="privacy section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-10 mx-auto">

            <div class="privacy-content">
              <div class="last-updated" data-aos="fade-up" data-aos-delay="200">
                <p><strong>{{ __('privacy.last_updated') }}</strong> {{ __('privacy.last_updated_date') }}</p>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="300">
                <h3>{{ __('privacy.info_we_collect') }}</h3>
                <p>{{ __('privacy.info_we_collect_intro') }}</p>

                <h4>{{ __('privacy.personal_info') }}</h4>
                <ul>
                  <li>{{ __('privacy.personal_info_1') }}</li>
                  <li>{{ __('privacy.personal_info_2') }}</li>
                  <li>{{ __('privacy.personal_info_3') }}</li>
                  <li>{{ __('privacy.personal_info_4') }}</li>
                </ul>

                <h4>{{ __('privacy.usage_data') }}</h4>
                <p>{{ __('privacy.usage_data_p') }}</p>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="400">
                <h3>{{ __('privacy.how_we_use') }}</h3>
                <p>{{ __('privacy.how_we_use_intro') }}</p>

                <div class="info-box">
                  <h4>{{ __('privacy.primary_uses') }}</h4>
                  <ol>
                    <li>{{ __('privacy.primary_uses_1') }}</li>
                    <li>{{ __('privacy.primary_uses_2') }}</li>
                    <li>{{ __('privacy.primary_uses_3') }}</li>
                    <li>{{ __('privacy.primary_uses_4') }}</li>
                  </ol>
                </div>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="500">
                <h3>{{ __('privacy.sharing_disclosure') }}</h3>
                <p>{{ __('privacy.sharing_intro') }}</p>

                <div class="highlight-box" data-aos="fade-up" data-aos-delay="600">
                  <i class="bi bi-shield-check"></i>
                  <h4>{{ __('privacy.never_sell_title') }}</h4>
                  <p>{{ __('privacy.never_sell_p') }}</p>
                </div>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="700">
                <h3>{{ __('privacy.data_security') }}</h3>
                <p>{{ __('privacy.data_security_intro') }}</p>

                <div class="security-measures">
                  <div class="row">
                    <div class="col-md-6" data-aos="fade-right" data-aos-delay="800">
                      <div class="measure-item">
                        <i class="bi bi-lock-fill"></i>
                        <h5>{{ __('privacy.encryption_title') }}</h5>
                        <p>{{ __('privacy.encryption_p') }}</p>
                      </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-left" data-aos-delay="900">
                      <div class="measure-item">
                        <i class="bi bi-server"></i>
                        <h5>{{ __('privacy.secure_storage_title') }}</h5>
                        <p>{{ __('privacy.secure_storage_p') }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="1000">
                <h3>{{ __('privacy.your_rights') }}</h3>
                <p>{{ __('privacy.your_rights_intro') }}</p>

                <div class="rights-list">
                  <div class="right-item">
                    <i class="bi bi-eye"></i>
                    <div>
                      <h5>{{ __('privacy.right_access_title') }}</h5>
                      <p>{{ __('privacy.right_access_p') }}</p>
                    </div>
                  </div>
                  <div class="right-item">
                    <i class="bi bi-pencil"></i>
                    <div>
                      <h5>{{ __('privacy.right_rectification_title') }}</h5>
                      <p>{{ __('privacy.right_rectification_p') }}</p>
                    </div>
                  </div>
                  <div class="right-item">
                    <i class="bi bi-trash"></i>
                    <div>
                      <h5>{{ __('privacy.right_erasure_title') }}</h5>
                      <p>{{ __('privacy.right_erasure_p') }}</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="1100">
                <h3>{{ __('privacy.cookies_tracking') }}</h3>
                <p>{{ __('privacy.cookies_intro') }}</p>

                <div class="cookie-types">
                  <h4>{{ __('privacy.cookie_types_title') }}</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>{{ __('privacy.cookie_type') }}</th>
                          <th>{{ __('privacy.purpose') }}</th>
                          <th>{{ __('privacy.duration') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{ __('privacy.essential') }}</td>
                          <td>{{ __('privacy.essential_purpose') }}</td>
                          <td>{{ __('privacy.session') }}</td>
                        </tr>
                        <tr>
                          <td>{{ __('privacy.analytics') }}</td>
                          <td>{{ __('privacy.analytics_purpose') }}</td>
                          <td>{{ __('privacy.months_13') }}</td>
                        </tr>
                        <tr>
                          <td>{{ __('privacy.marketing') }}</td>
                          <td>{{ __('privacy.marketing_purpose') }}</td>
                          <td>{{ __('privacy.months_6') }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="1200">
                <h3>{{ __('privacy.changes_policy') }}</h3>
                <p>{{ __('privacy.changes_policy_p') }}</p>
              </div>

              <div class="contact-section" data-aos="fade-up" data-aos-delay="1300">
                <h3>{{ __('privacy.contact_title') }}</h3>
                <p>{{ __('privacy.contact_intro') }}</p>

                <div class="contact-info">
                  <div class="contact-item">
                    <i class="bi bi-envelope"></i>
                    <span>{{ config('app.gymivida_email') }}</span>
                  </div>
                  <div class="contact-item">
                    <i class="bi bi-geo-alt"></i>
                    <span>{{ __('privacy.contact_address') }}</span>
                  </div>
                  <div class="contact-item">
                    <i class="bi bi-telephone"></i>
                    <span>{{ config('app.gymivida_phone') }}</span>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>

    </section><!-- /Privacy Section -->
@endsection