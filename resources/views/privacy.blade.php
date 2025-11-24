@extends('layout.master')

@section('title', 'Privacy')

@section('body-class', 'privacy-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="breadcrumbs">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house"></i> Home</a></li>
            <li class="breadcrumb-item active current">Privacy</li>
          </ol>
        </nav>
      </div>

      <div class="title-wrapper">
        <h1>Privacy</h1>
        <p>Gymivida is built for trust. This privacy notice explains how we handle the information gyms, staff, and members share with us while using our management platform.</p>
      </div>
    </div><!-- End Page Title -->

    <!-- Privacy Section -->
    <section id="privacy" class="privacy section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-10 mx-auto">

            <div class="privacy-content">
              <div class="last-updated" data-aos="fade-up" data-aos-delay="200">
                <p><strong>Last updated:</strong> November 24, 2025</p>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="300">
                <h3>Information We Collect</h3>
                <p>We only gather the data required to operate a secure, reliable gym management experience. This includes information provided directly by gym owners, staff, and members, along with system telemetry that helps us keep the platform healthy.</p>

                <h4>Personal Information</h4>
                <ul>
                  <li>Account details such as name, email, phone number, and role inside your organization</li>
                  <li>Business information including gym name, branch locations, subscription preferences, and billing contacts</li>
                  <li>Member records entered by your team (attendance history, membership plans, progress notes, and consents)</li>
                  <li>Support conversations and feedback shared with the Gymivida success team</li>
                </ul>

                <h4>Usage Data</h4>
                <p>We log device identifiers, browser type, IP address, pages visited, feature usage, and timestamps whenever someone interacts with the dashboard or API. This technical data is anonymized where possible and used solely for performance tuning, fraud prevention, and product analytics.</p>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="400">
                <h3>How We Use Your Information</h3>
                <p>Data fuels the automations inside Gymivida. We process the information you provide to configure memberships, automate reminders, surface analytics, and deliver proactive assistance.</p>

                <div class="info-box">
                  <h4>Primary Uses</h4>
                  <ol>
                    <li>Provisioning accounts, authenticating users, and authorizing staff based on roles and permissions</li>
                    <li>Managing billing cycles, digital contracts, and payment reconciliation for each gym location</li>
                    <li>Sending transactional communications such as receipts, renewal reminders, incident alerts, and product updates</li>
                    <li>Improving features through aggregated analytics, A/B testing, and anonymized benchmarking</li>
                  </ol>
                </div>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="500">
                <h3>Information Sharing and Disclosure</h3>
                <p>Gymivida does not monetize customer data. We only share information with trusted partners when it is essential to deliver contracted services, comply with the law, or respond to emergencies.</p>

                <div class="highlight-box" data-aos="fade-up" data-aos-delay="600">
                  <i class="bi bi-shield-check"></i>
                  <h4>We Never Sell Your Data</h4>
                  <p>Third parties such as payment gateways, SMS providers, or analytics platforms receive the minimum fields needed to fulfill their role, and every vendor is bound by confidentiality and data-processing agreements.</p>
                </div>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="700">
                <h3>Data Security</h3>
                <p>We combine technical and organizational safeguards to keep Gymivida resilient. Infrastructure is hosted on hardened cloud environments with continuous monitoring, least-privilege access control, and regular penetration testing.</p>

                <div class="security-measures">
                  <div class="row">
                    <div class="col-md-6" data-aos="fade-right" data-aos-delay="800">
                      <div class="measure-item">
                        <i class="bi bi-lock-fill"></i>
                        <h5>Encryption</h5>
                        <p>All traffic is protected with TLS 1.2+ and sensitive records are encrypted at rest using AES-256 keys rotated through managed services.</p>
                      </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-left" data-aos-delay="900">
                      <div class="measure-item">
                        <i class="bi bi-server"></i>
                        <h5>Secure Storage</h5>
                        <p>Backups, audit logs, and media assets live in isolated networks with automated patching, MFA enforcement, and disaster-recovery drills.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="1000">
                <h3>Your Rights</h3>
                <p>You remain in control of the data stored inside Gymivida. Depending on your jurisdiction, you may exercise the privacy rights below by emailing our support team or submitting a request from inside the platform settings.</p>

                <div class="rights-list">
                  <div class="right-item">
                    <i class="bi bi-eye"></i>
                    <div>
                      <h5>Right to Access</h5>
                      <p>Request a copy of the personal information and activity logs associated with your organization.</p>
                    </div>
                  </div>
                  <div class="right-item">
                    <i class="bi bi-pencil"></i>
                    <div>
                      <h5>Right to Rectification</h5>
                      <p>Update inaccurate information or adjust member records to reflect the latest agreements and consents.</p>
                    </div>
                  </div>
                  <div class="right-item">
                    <i class="bi bi-trash"></i>
                    <div>
                      <h5>Right to Erasure</h5>
                      <p>Ask us to delete or anonymize personal data when it is no longer required for legal, contractual, or security reasons.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="1100">
                <h3>Cookies and Tracking</h3>
                <p>Cookies help us remember user preferences, keep sessions secure, and understand which features create value. You can manage cookies through your browser settings, although disabling them may degrade certain workflows.</p>

                <div class="cookie-types">
                  <h4>Types of Cookies We Use</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Cookie Type</th>
                          <th>Purpose</th>
                          <th>Duration</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Essential</td>
                          <td>Authenticates dashboard sessions, maintains CSRF protection, and stores opt-in choices</td>
                          <td>Session</td>
                        </tr>
                        <tr>
                          <td>Analytics</td>
                          <td>Measures feature adoption, detects crashes, and guides product improvements</td>
                          <td>13 Months</td>
                        </tr>
                        <tr>
                          <td>Marketing</td>
                          <td>Supports opt-in nurture campaigns, webinar reminders, and personalized onboarding tips</td>
                          <td>6 Months</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="privacy-section" data-aos="fade-up" data-aos-delay="1200">
                <h3>Changes to This Privacy Policy</h3>
                <p>We review this notice whenever we release new functionality or onboard fresh partners. When updates are significant, we will notify workspace owners via email and highlight the summary inside the dashboard.</p>
              </div>

              <div class="contact-section" data-aos="fade-up" data-aos-delay="1300">
                <h3>Contact Us</h3>
                <p>If you have questions about privacy, data processing agreements, or need a signed copy of our Subprocessor List, reach out anytime.</p>

                <div class="contact-info">
                  <div class="contact-item">
                    <i class="bi bi-envelope"></i>
                    <span>{{ config('app.gymivida_email') }}</span>
                  </div>
                  <div class="contact-item">
                    <i class="bi bi-geo-alt"></i>
                    <span>Smart City Business District, Cairo, Egypt</span>
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