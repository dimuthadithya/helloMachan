@props(['feedback'])

<div class="bg-white rounded-lg shadow-sm p-4 mb-4">
    <div class="flex items-center mb-3">
        <div class="flex-shrink-0">
            <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center">
                <i class="bi bi-person-circle"></i>
            </div>
        </div>
        <div class="ml-3">
            <h6 class="font-semibold mb-0">{{ $feedback->user->name }}</h6>
            <div class="text-warning">
                @for ($i = 0; $i < $feedback->rating; $i++)
                    <i class="bi bi-star-fill"></i>
                    @endfor
                    @for ($i = $feedback->rating; $i < 5; $i++)
                        <i class="bi bi-star"></i>
                        @endfor
            </div>
        </div>
        <div class="ml-auto text-muted small">
            {{ $feedback->created_at->diffForHumans() }}
        </div>
    </div>
    <p class="mb-0 text-gray-600">{{ $feedback->comment }}</p>

    @if($feedback->order?->items)
    <div class="mt-3 pt-3 border-t">
        <small class="text-muted">Ordered:</small>
        <div class="mt-1">
            @foreach($feedback->order->items->take(2) as $item)
            <span class="badge bg-light text-dark me-2">{{ $item->menuItem->name }}</span>
            @endforeach
            @if($feedback->order->items->count() > 2)
            <span class="badge bg-light text-dark">+{{ $feedback->order->items->count() - 2 }} more</span>
            @endif
        </div>
    </div>
    @endif
</div>