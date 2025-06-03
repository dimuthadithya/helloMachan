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
            <h1 class="mb-5">Our Delicious Menu</h1>
        </div>

        <!-- Category Navigation -->
        @if($categories->count() > 0)
        <div class="text-center mb-5 tab-class wow fadeInUp" data-wow-delay="0.1s">
            <ul class="mb-4 nav nav-pills d-inline-flex justify-content-center border-bottom">
                <li class="nav-item">
                    <a class="pb-3 mx-3 d-flex align-items-center text-start active" data-bs-toggle="pill" href="#all">
                        <i class="fa fa-utensils fa-2x text-primary"></i>
                        <div class="ps-3">
                            <small class="text-body">All</small>
                            <h6 class="mb-0 mt-n1">Items</h6>
                        </div>
                    </a>
                </li>
                @foreach($categories as $category)
                <li class="nav-item">
                    <a class="pb-3 mx-3 d-flex align-items-center text-start" data-bs-toggle="pill" href="#category-{{ $category->id }}">
                        <i class="fa fa-utensils fa-2x text-primary"></i>
                        <div class="ps-3">
                            <small class="text-body">{{ $category->menuItems_count }} items</small>
                            <h6 class="mb-0 mt-n1">{{ $category->name }}</h6>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="tab-content wow fadeInUp" data-wow-delay="0.1s">
            <!-- All Items Tab -->
            <div class="tab-pane fade show active" id="all">
                <div class="row g-4">
                    @forelse($items as $item)
                    <div class="col-lg-6">
                        <x-menu-card
                            :image-path="Storage::url($item->image)"
                            :name="$item->name"
                            :price="number_format($item->price, 2)"
                            :description="$item->description" />
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="mb-3 bi bi-inbox display-4 text-secondary"></i>
                        <p class="mb-0 text-secondary">No menu items available</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Category Tabs -->
            @foreach($categories as $category)
            <div class="tab-pane fade" id="category-{{ $category->id }}">
                <div class="row g-4">
                    @php
                    $categoryItems = $items->where('category_id', $category->id);
                    @endphp
                    @forelse($categoryItems as $item)
                    <div class="col-lg-6">
                        <x-menu-card
                            :image-path="Storage::url($item->image)"
                            :name="$item->name"
                            :price="number_format($item->price, 2)"
                            :description="$item->description" />
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="mb-3 bi bi-inbox display-4 text-secondary"></i>
                        <p class="mb-0 text-secondary">No items available in this category</p>
                    </div>
                    @endforelse
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Menu End -->
@endsection