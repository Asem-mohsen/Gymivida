<footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <span class="sitename">Gymivida</span>
          </a>
          <p>Gymivida is the all-in-one gym management system designed to simplify daily operations, enhance member experience, and help gym owners grow faster. Manage branches, trainers, memberships, and reports — all in one smart platform.</p>
          <div class="social-links d-flex mt-4">
            <a href="#"><i class="bi bi-twitter-x"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
  
        <div class="col-lg-2 col-6 footer-links">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#pricing">Pricing</a></li>
            <li><a href="{{ route('terms') }}">Terms</a></li>
            <li><a href="{{ route('privacy') }}">Privacy</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
  
        <div class="col-lg-2 col-6 footer-links">
          <h4>Services</h4>
          <ul>
            <li><a href="#services">Gym & Branch Management</a></li>
            <li><a href="#services">Staff & Trainer Control</a></li>
            <li><a href="#services">Attendance & Reports</a></li>
            <li><a href="#services">Performance Scoring</a></li>
            <li><a href="#services">Data Migration Tools</a></li>
          </ul>
        </div>
  
        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>Smart City Business District</p>
          <p>Cairo, Egypt</p>
          <p class="mt-4"><strong>Phone:</strong> <span>{{ config('app.gymivida_phone') }}</span></p>
          <p><strong>Email:</strong> <span>{{ config('app.gymivida_email') }}</span></p>
        </div>
  
      </div>
    </div>
  
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ config('app.name') }}</strong> <span>All Rights Reserved</span></p>
    </div>
</footer>
  

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader" aria-label="Loading Gymivida">
    <div class="preloader-logo">
      <span>G</span>
      <span>Y</span>
      <span>M</span>
      <span>I</span>
      <span>V</span>
      <span>I</span>
      <span>D</span>
      <span>A</span>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  @include('components.toastr')