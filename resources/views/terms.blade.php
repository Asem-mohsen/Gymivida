@extends('layout.master')

@section('title', 'Terms')

@section('body-class', 'terms-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="breadcrumbs">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house"></i> Home</a></li>
            <li class="breadcrumb-item active current">Terms</li>
          </ol>
        </nav>
      </div>

      <div class="title-wrapper">
        <h1>Terms</h1>
        <p>These terms govern how gyms, staff, and partners use the Gymivida platform, APIs, and related services. Please review them carefully before activating your workspace.</p>
      </div>
    </div>
    <!-- End Page Title -->

    <!-- Terms Of Service Section -->
    <section id="terms-of-service" class="terms-of-service section">

      <div class="container" data-aos="fade-up">
        <!-- Page Header -->
        <div class="tos-header text-center" data-aos="fade-up">
          <span class="last-updated">Last Updated: November 24, 2025</span>
        </div>

        <!-- Content -->
        <div class="tos-content" data-aos="fade-up" data-aos-delay="200">
          <!-- Agreement Section -->
          <div id="agreement" class="content-section">
            <h3>1. Agreement to Terms</h3>
            <p>By creating a Gymivida workspace, signing an order form, or accessing any part of the platform, you acknowledge that you have read, understood, and agree to these Terms of Service and our Privacy Policy. If you are accepting on behalf of a company, you confirm that you have the authority to bind that company to this agreement.</p>
            <div class="info-box">
              <i class="bi bi-info-circle"></i>
              <p>These terms apply to every user — founders, branch managers, trainers, front-desk staff, contractors, and guests — who signs in to Gymivida or interacts with our APIs.</p>
            </div>
          </div>

          <!-- Intellectual Property -->
          <div id="intellectual-property" class="content-section">
            <h3>2. Intellectual Property Rights</h3>
            <p>The Gymivida brand, source code, designs, and documentation are owned by Gymivida or its licensors. Your subscription grants a limited, revocable license to use the software for your internal gym operations.</p>
            <ul class="list-items">
              <li>You may not reverse engineer, decompile, or create derivative works of the platform</li>
              <li>Logos, product names, and interface assets cannot be used without written permission</li>
              <li>We may reference your gym name and logo as part of customer lists unless you opt out in writing</li>
              <li>Data you upload remains yours; we only process it to deliver contracted features</li>
            </ul>
          </div>

          <!-- User Accounts -->
          <div id="user-accounts" class="content-section">
            <h3>3. User Accounts</h3>
            <p>Workspace owners are responsible for inviting and managing team members. You must provide accurate information, maintain unique login credentials for each user, and immediately notify us of any unauthorized access or suspected breach.</p>
            <div class="alert-box">
              <i class="bi bi-exclamation-triangle"></i>
              <div class="alert-content">
                <h5>Important Notice</h5>
                <p>You are accountable for the actions performed with your credentials, including data entered into the system and communications triggered from your workspace.</p>
              </div>
            </div>
          </div>

          <!-- Prohibited Activities -->
          <div id="prohibited" class="content-section">
            <h3>4. Prohibited Activities</h3>
            <p>Gymivida must be used responsibly. Any misuse that degrades service performance, harms other customers, or circumvents billing obligations is strictly forbidden.</p>
            <div class="prohibited-list">
              <div class="prohibited-item">
                <i class="bi bi-x-circle"></i>
                <span>Scraping, bulk exporting, or systematically retrieving content outside of approved APIs</span>
              </div>
              <div class="prohibited-item">
                <i class="bi bi-x-circle"></i>
                <span>Uploading malicious code, performing penetration tests without consent, or attempting to bypass security controls</span>
              </div>
              <div class="prohibited-item">
                <i class="bi bi-x-circle"></i>
                <span>Reselling the platform or offering shared logins outside your organization</span>
              </div>
              <div class="prohibited-item">
                <i class="bi bi-x-circle"></i>
                <span>Attempting to access data that belongs to another customer or branch without authorization</span>
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
            <h3>6. Limitation of Liability</h3>
            <p>To the maximum extent permitted by law, Gymivida and its affiliates are not liable for lost profits, lost data, business interruption, or indirect damages. Our aggregate liability for any claim is limited to the fees you paid to Gymivida during the twelve (12) months preceding the incident.</p>
          </div>

          <!-- Indemnification -->
          <div id="indemnification" class="content-section">
            <h3>7. Indemnification</h3>
            <p>You agree to defend and indemnify Gymivida, its officers, employees, and partners against claims arising from your misuse of the platform, violation of these terms, infringement of third-party rights, or breach of applicable laws while using our services.</p>
          </div>

          <!-- Termination -->
          <div id="termination" class="content-section">
            <h3>8. Termination</h3>
            <p>We may suspend or terminate access if you fail to pay fees, materially breach these terms, or pose a security risk. You may terminate at the end of your billing cycle by providing the notice stated in your order form. Upon termination, you remain responsible for outstanding amounts and we can provide a data export upon request.</p>
          </div>

          <!-- Governing Law -->
          <div id="governing-law" class="content-section">
            <h3>9. Governing Law</h3>
            <p>These Terms are governed by the laws of the Arab Republic of Egypt. Any dispute that cannot be resolved informally will be submitted to the competent courts in Cairo, subject to each party’s right to seek urgent injunctive relief elsewhere.</p>
          </div>

          <!-- Changes -->
          <div id="changes" class="content-section">
            <h3>10. Changes to Terms</h3>
            <p>We may update these terms to reflect new features, regulatory requirements, or pricing models. Material changes will be communicated by email or in-app banners at least 14 days before they take effect, unless the change addresses a security issue or legal obligation.</p>
            <div class="notice-box">
              <i class="bi bi-bell"></i>
              <p>Continuing to use Gymivida after the effective date of a change constitutes acceptance of the revised terms.</p>
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
              <h4>Questions About Terms?</h4>
              <p>If you have any questions about these Terms, please contact us.</p>
              <a href="{{ route('home') }}#contact" class="contact-link">Contact Support</a>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /Terms Of Service Section -->

@endsection