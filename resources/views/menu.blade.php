@extends('layouts.app')

@section('content')
<!-- Page Header Start -->
<div class="mb-5 container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="mb-3 text-white display-3 animated slideInLeft">Menu</h1>
        <nav aria-label="breadcrumb animated slideInRight">
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Menu</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Menu Start -->
<div class="py-5 container-fluid">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="text-center section-title ff-secondary text-primary fw-normal">Food Menu</h5>
            <h1 class="mb-5">Most Popular Items</h1>
        </div>
        <div class="text-center tab-class wow fadeInUp" data-wow-delay="0.1s">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="all">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <x-menu-card
                                image-path="assets/img/menu-1.jpg"
                                name="Chicken Burger"
                                price="15.00"
                                description="A juicy chicken patty with fresh vegetables and special sauce" />
                        </div>
                        <div class="col-lg-6">
                            <x-menu-card
                                image-path="assets/img/menu-2.jpg"
                                name="Kottu Special"
                                price="18.00"
                                description="Our signature kottu with your choice of chicken, beef, or vegetables" />
                        </div>
                        <div class="col-lg-6">
                            <x-menu-card
                                image-path="assets/img/menu-3.jpg"
                                name="Rice and Curry"
                                price="12.00"
                                description="Traditional Sri Lankan rice and curry with 4 vegetables" />
                        </div>
                        <div class="col-lg-6">
                            <x-menu-card
                                image-path="assets/img/menu-4.jpg"
                                name="String Hoppers"
                                price="10.00"
                                description="Fresh string hoppers served with curry sauce and coconut sambol" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Menu End -->
@endsection