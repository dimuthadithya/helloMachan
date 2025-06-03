@props(['imagePath', 'name', 'price', 'description', 'itemId'])

<div class="d-flex align-items-center position-relative">
    <img class="flex-shrink-0 rounded img-fluid" src="{{ asset($imagePath) }}" alt="{{ $name }}" style="width: 80px" />
    <div class="w-100 d-flex flex-column text-start ps-4">
        <h5 class="pb-2 d-flex justify-content-between border-bottom">
            <span>{{ $name }}</span>
            <span class="text-primary">${{ $price }}</span>
        </h5>
        <div class="d-flex justify-content-between align-items-center">
            <small class="fst-italic flex-grow-1">{{ $description }}</small>
            <form action="{{ route('cart.add') }}" method="POST" class="ms-3">
                @csrf
                <input type="hidden" name="menu_item_id" value="{{ $itemId }}">
                <button type="submit" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>