@if($order->status === 'completed' && !$order->feedback)
<div class="p-4 mt-4 bg-white rounded shadow-sm">
    <h5 class="mb-3">Share Your Feedback</h5>
    <form action="{{ route('orders.feedback.store', $order) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="rating-input">
                @for($i = 5; $i >= 1; $i--)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating"
                        id="rating{{ $i }}" value="{{ $i }}" required
                        {{ old('rating') == $i ? 'checked' : '' }}>
                    <label class="form-check-label" for="rating{{ $i }}">
                        <i class="bi bi-star-fill text-warning"></i>
                    </label>
                </div>
                @endfor
            </div>
            @error('rating')
            <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Your Feedback</label>
            <textarea class="form-control @error('comment') is-invalid @enderror"
                id="comment" name="comment" rows="3" required
                placeholder="Share your experience with this order">{{ old('comment') }}</textarea>
            @error('comment')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-send me-2"></i>Submit Feedback
        </button>
    </form>
</div>
@endif