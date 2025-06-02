@extends('layouts.app')

@section('content')
    <div class="container-xxl bg-white p-0">
      <!-- Spinner Start -->
      <div
        id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
      >
        <div
          class="spinner-border text-primary"
          style="width: 3rem; height: 3rem"
          role="status"
        >
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <!-- Spinner End -->

      <!-- All the other sections from your content -->
      <!-- Navbar & Hero Start -->
      <div class="container-xxl position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
          <a href="" class="navbar-brand p-0">
            <h1 class="text-primary m-0">
              <i class="fa fa-utensils me-3"></i>Hello Machan
            </h1>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
          >
            <span class="fa fa-bars"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
              <a href="index.html" class="nav-item nav-link active">Home</a>
              <a href="about.html" class="nav-item nav-link">About</a>
              <a href="menu.html" class="nav-item nav-link">Menu</a>
              <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="#booking" class="btn btn-primary py-2 px-4">Book A Table</a>
          </div>
        </nav>

        <!-- Hero section -->
        <div class="container-xxl py-5 bg-dark hero-header mb-5">
          <div class="container my-5 py-5">
            <div class="row align-items-center g-5">
              <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">
                  Enjoy Our<br />Delicious Meal
                </h1>
                <p class="text-white animated slideInLeft mb-4 pb-2">
                  Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.
                  Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit,
                  sed stet lorem sit clita duo justo magna dolore erat amet
                </p>
                <a href="#booking" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Book A Table</a>
              </div>
              <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="{{ asset('assets/img/hero.png') }}" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Navbar & Hero End -->

      <!-- All other sections -->
      <!-- Service, About, Menu, Reservation, Team, Testimonial sections go here -->
      <!-- I'll continue with those in subsequent edits -->

      <!-- Footer Start -->
      <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <!-- Footer content -->
      </div>
      <!-- Footer End -->

      <!-- Back to Top -->
      <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
@endsection