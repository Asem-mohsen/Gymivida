@extends('layout.master')

@section('title', __('terms.title'))

@section('body-class', 'terms-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="breadcrumbs">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home', ['locale' => $currentLocale]) }}"><i class="bi bi-house"></i> {{ __('nav.home') }}</a></li>
            <li class="breadcrumb-item active current">{{ __('terms.breadcrumb') }}</li>
          </ol>
        </nav>
      </div>

      <div class="title-wrapper">
        <h1>{{ __('terms.title') }}</h1>
        <p>{{ __('terms.intro') }}</p>
      </div>
    </div>
    <!-- End Page Title -->

    <!-- Terms Of Service Section -->
    <section id="terms-of-service" class="terms-of-service section">

      <div class="container" data-aos="fade-up">
        <!-- Page Header -->
        <div class="tos-header text-center" data-aos="fade-up">
          <span class="last-updated">{{ __('terms.last_updated') }}</span>
        </div>

        <!-- Content -->
        <div class="tos-content" data-aos="fade-up" data-aos-delay="200">
          <!-- Agreement Section -->
          <div id="agreement" class="content-section">
            <h3>{{ __('terms.agreement_title') }}</h3>
            <p>{{ __('terms.agreement_p') }}</p>
            <div class="info-box">
              <i class="bi bi-info-circle"></i>
              <p>{{ __('terms.agreement_note') }}</p>
            </div>
          </div>

          <!-- Intellectual Property -->
          <div id="intellectual-property" class="content-section">
            <h3>{{ __('terms.ip_title') }}</h3>
            <p>{{ __('terms.ip_p') }}</p>
            <ul class="list-items">
              <li>{{ __('terms.ip_1') }}</li>
              <li>{{ __('terms.ip_2') }}</li>
              <li>{{ __('terms.ip_3') }}</li>
              <li>{{ __('terms.ip_4') }}</li>
            </ul>
          </div>

          <!-- User Accounts -->
          <div id="user-accounts" class="content-section">
            <h3>{{ __('terms.accounts_title') }}</h3>
            <p>{{ __('terms.accounts_p') }}</p>
            <div class="alert-box">
              <i class="bi bi-exclamation-triangle"></i>
              <div class="alert-content">
                <h5>{{ __('terms.accounts_notice_title') }}</h5>
                <p>{{ __('terms.accounts_notice_p') }}</p>
              </div>
            </div>
          </div>

          <!-- Prohibited Activities -->
          <div id="prohibited" class="content-section">
            <h3>{{ __('terms.prohibited_title') }}</h3>
            <p>{{ __('terms.prohibited_p') }}</p>
            <div class="prohibited-list">
              <div class="prohibited-item">
                <i class="bi bi-x-circle"></i>
                <span>{{ __('terms.prohibited_1') }}</span>
              </div>
              <div class="prohibited-item">
                <i class="bi bi-x-circle"></i>
                <span>{{ __('terms.prohibited_2') }}</span>
              </div>
              <div class="prohibited-item">
                <i class="bi bi-x-circle"></i>
                <span>{{ __('terms.prohibited_3') }}</span>
              </div>
              <div class="prohibited-item">
                <i class="bi bi-x-circle"></i>
                <span>{{ __('terms.prohibited_4') }}</span>
              </div>
            </div>
          </div>

          <!-- Disclaimers -->
          <div id="disclaimer" class="content-section">
            <h3>5. Disclaimers</h3>
            <p>We continuously test and improve Gymivida, but software has inherent risks. The service is provided “as is” and “as available” without warranties of merchantability, fitness for a particular purpose, or non-infringement.</p>
            <div class="disclaimer-box">
              <p>We do not guarantee that:</p>
              <ul>
                <li>All features will meet every operational requirement or local regulation</li>
                <li>The platform will be uninterrupted, timely, secure, or error-free at all times</li>
                <li>Analytics and predictions will always match real-world outcomes</li>
                <li>Defects will be corrected immediately, although we will use reasonable efforts to address them</li>
              </ul>
            </div>
          </div>

          <!-- Limitation of Liability -->
          <div id="limitation" class="content-section">
            <h3>{{ __('terms.limitation_title') }}</h3>
            <p>{{ __('terms.limitation_p') }}</p>
          </div>

          <!-- Indemnification -->
          <div id="indemnification" class="content-section">
            <h3>{{ __('terms.indemnification_title') }}</h3>
            <p>{{ __('terms.indemnification_p') }}</p>
          </div>

          <!-- Refund Policy -->
          <div id="refund-policy" class="content-section">
            <h3>{{ __('terms.refund_title') }}</h3>
            <p>{{ __('terms.refund_1') }}</p>
            <p>{{ __('terms.refund_2') }}</p>
            <p>{{ __('terms.refund_3') }}</p>
            <p>{{ __('terms.refund_4') }}</p>
            <p>{{ __('terms.refund_5') }}</p>
            <p>{{ __('terms.refund_6') }}</p>
          </div>

          <!-- Termination -->
          <div id="termination" class="content-section">
            <h3>{{ __('terms.termination_title') }}</h3>
            <p>{{ __('terms.termination_p') }}</p>
          </div>

          <!-- Governing Law -->
          <div id="governing-law" class="content-section">
            <h3>{{ __('terms.governing_title') }}</h3>
            <p>{{ __('terms.governing_p') }}</p>
          </div>

          <!-- Changes -->
          <div id="changes" class="content-section">
            <h3>{{ __('terms.changes_title') }}</h3>
            <p>{{ __('terms.changes_p') }}</p>
            <div class="notice-box">
              <i class="bi bi-bell"></i>
              <p>{{ __('terms.changes_notice') }}</p>
            </div>
          </div>
        </div>

        <!-- Contact Section -->
        <div class="tos-contact" data-aos="fade-up" data-aos-delay="300">
          <div class="contact-box">
            <div class="contact-icon">
              <i class="bi bi-envelope"></i>
            </div>
            <div class="contact-content">
              <h4>{{ __('terms.contact_questions') }}</h4>
              <p>{{ __('terms.contact_intro') }}</p>
              <a href="{{ route('home', ['locale' => $currentLocale]) }}#contact" class="contact-link">{{ __('terms.contact_link') }}</a>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /Terms Of Service Section -->

@endsection