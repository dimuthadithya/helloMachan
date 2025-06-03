@extends('layouts.app')

@section('content')
<div class="p-0 container-fluid">
    <!-- Hero Section Start -->
    <div class="py-5 mb-5 bg-dark hero-header">
        <div class="container py-5 my-5">
            <div class="row align-items-center g-5">
                <div class="text-center col-lg-6 text-lg-start">
                    <h1 class="text-white display-3 animated slideInLeft">
                        Enjoy Our<br />Delicious Meal
                    </h1>
                    <p class="pb-2 mb-4 text-white animated slideInLeft">
                        Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.
                        Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit,
                        sed stet lorem sit clita duo justo magna dolore erat amet
                    </p>
                </div>
                <div class="overflow-hidden text-center col-lg-6 text-lg-end">
                    <img class="img-fluid" src="{{ asset('assets/img/hero.png') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- Service Start -->
    <div class="py-5 container-xxl">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="pt-3 rounded service-item">
                        <div class="p-4">
                            <i class="mb-4 fa fa-3x fa-user-tie text-primary"></i>
                            <h5>Master Chefs</h5>
                            <p>
                                Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                                amet diam
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="pt-3 rounded service-item">
                        <div class="p-4">
                            <i class="mb-4 fa fa-3x fa-utensils text-primary"></i>
                            <h5>Quality Food</h5>
                            <p>
                                Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                                amet diam
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="pt-3 rounded service-item">
                        <div class="p-4">
                            <i class="mb-4 fa fa-3x fa-cart-plus text-primary"></i>
                            <h5>Online Order</h5>
                            <p>
                                Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                                amet diam
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="pt-3 rounded service-item">
                        <div class="p-4">
                            <i class="mb-4 fa fa-3x fa-headset text-primary"></i>
                            <h5>24/7 Service</h5>
                            <p>
                                Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                                amet diam
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Customer Feedback Start -->
    <div class="py-5 container-xxl">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="text-center ff-secondary text-primary fw-normal">Customer Reviews</h5>
                <h1 class="mb-5">What Our Customers Say</h1>
            </div>
            <div class="row g-4">
                @foreach(\App\Models\Feedback::where('is_approved', true)->where('is_featured', true)->latest()->take(3)->get() as $feedback)
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="{{ 0.1 + $loop->index * 0.2 }}s">
                    <x-feedback-card :feedback="$feedback" />
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Customer Feedback End -->

    <!-- Menu Start -->
    <div class="py-5 container-xxl">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="text-center ff-secondary text-primary fw-normal">Food Menu</h5>
                <h1 class="mb-5">Most Popular Items</h1>
            </div>
            <div class="row g-4">
                @foreach(\App\Models\MenuItem::where('is_available', true)->inRandomOrder()->take(6)->get() as $item)
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="{{ 0.1 + $loop->index * 0.1 }}s">
                    <x-menu-card
                        :imagePath="$item->image ? 'storage/'.$item->image : 'img/default-food.jpg'"
                        :name="$item->name"
                        :price="number_format($item->price, 2)"
                        :description="$item->description"
                        :itemId="$item->id" />
                </div>
                @endforeach
            </div>
            <div class="mt-5 text-center wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ route('menu') }}" class="px-5 py-3 btn btn-primary">View Full Menu</a>
            </div>
        </div>
    </div>
    <!-- Menu End --> @endsection