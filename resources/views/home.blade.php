@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
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
                    <a href="#booking" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Book A Table</a>
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
                <h5 class="ff-secondary text-center text-primary fw-normal">Customer Reviews</h5>
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
                <h5 class="ff-secondary text-center text-primary fw-normal">Food Menu</h5>
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
                        :itemId="$item->id"
                    />
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5 wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ route('menu') }}" class="btn btn-primary py-3 px-5">View Full Menu</a>
            </div>
        </div>
    </div>
    <!-- Menu End -->

    <!-- Reservation Start -->
    <div class="px-0 py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="video">
                    <button
                        type="button"
                        class="btn-play"
                        data-bs-toggle="modal"
                        data-src="https://www.youtube.com/embed/DWRcNpR6Kdc"
                        data-bs-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 bg-dark d-flex align-items-center">
                <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h5
                        class="section-title ff-secondary text-start text-primary fw-normal">
                        Reservation
                    </h5>
                    <h1 class="mb-4 text-white">Book A Table Online</h1>
                    <form id="booking">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        placeholder="Your Name" />
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        placeholder="Your Email" />
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-floating date"
                                    id="date3"
                                    data-target-input="nearest">
                                    <input
                                        type="text"
                                        class="form-control datetimepicker-input"
                                        id="datetime"
                                        placeholder="Date & Time"
                                        data-target="#date3"
                                        data-toggle="datetimepicker" />
                                    <label for="datetime">Date & Time</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="select1">
                                        <option value="1">People 1</option>
                                        <option value="2">People 2</option>
                                        <option value="3">People 3</option>
                                        <option value="3">People 4</option>
                                        <option value="3">People 5</option>
                                        <option value="3">People 6</option>
                                    </select>
                                    <label for="select1">No Of People</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea
                                        class="form-control"
                                        placeholder="Special Request"
                                        id="message"
                                        style="height: 100px"></textarea>
                                    <label for="message">Special Request</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="py-3 btn btn-primary w-100" type="submit">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div
        class="modal fade"
        id="videoModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe
                            class="embed-responsive-item"
                            src=""
                            id="video"
                            allowfullscreen
                            allowscriptaccess="always"
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reservation Start -->
    @endsection