@props(['imagePath', 'name', 'price', 'description'])

<div class="d-flex align-items-center">
    <img class="flex-shrink-0 rounded img-fluid" src="{{ asset($imagePath) }}" alt="{{ $name }}" style="width: 80px" />
    <div class="w-100 d-flex flex-column text-start ps-4">
        <h5 class="pb-2 d-flex justify-content-between border-bottom">
            <span>{{ $name }}</span>
            <span class="text-primary">${{ $price }}</span>
        </h5>
        <small class="fst-italic">{{ $description }}</small>
    </div>
</div>