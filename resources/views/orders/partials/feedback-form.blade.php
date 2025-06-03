@if($order->status === 'completed' && !$order->feedback)
<div class="p-4 mt-4 bg-white rounded shadow-sm">
    <h5 class="mb-3">Share Your Feedback</h5>
    <form action="{{ route('orders.feedback.store', $order) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label required">Rating</label>
            <div class="flex-row-reverse rating-input d-flex">
                @for($i = 5; $i >= 1; $i--)
                <div class="form-check form-check-inline ms-2">
                    <input class="form-check-input d-none" type="radio" name="rating"
                        id="rating{{ $i }}" value="{{ $i }}" required
                        {{ old('rating') == $i ? 'checked' : '' }}>
                    <label class="form-check-label star-label" for="rating{{ $i }}"
                        data-rating="{{ $i }}">
                        <i class="bi bi-star{{ old('rating') >= $i ? '-fill' : '' }} star-icon"></i>
                    </label>
                </div>
                @endfor
            </div>
            @error('rating')
            <div class="mt-1 text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label required">Your Feedback</label>
            <textarea class="form-control @error('comment') is-invalid @enderror"
                id="comment" name="comment" rows="3" required
                placeholder="Tell us about your experience with this order...">{{ old('comment') }}</textarea> @error('comment')
            <div class="invalid-feedback">{{ $errors->first('comment') }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-send me-2"></i>Submit Feedback
        </button>
    </form>
</div>

<style>
    .required:after {
        content: '*';
        color: red;
        margin-left: 3px;
    }

    .rating-input .star-label {
        cursor: pointer;
        font-size: 1.2rem;
    }

    .rating-input .star-icon {
        color: #ffc107;
        transition: all 0.2s;
    }

    .rating-input .star-label:hover .star-icon,
    .rating-input .star-label:hover~.star-label .star-icon {
        color: #ffc107;
    }

    .rating-input .star-label:hover .bi-star::before {
        content: "\f586";
        /* bi-star-fill */
    }

    .rating-input {
        display: inline-flex;
        flex-direction: row-reverse;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ratingInputs = document.querySelectorAll('.rating-input input[type="radio"]');
        const starLabels = document.querySelectorAll('.star-label');

        starLabels.forEach(label => {
            label.addEventListener('click', function() {
                const rating = this.dataset.rating;
                starLabels.forEach(l => {
                    const star = l.querySelector('.star-icon');
                    if (l.dataset.rating <= rating) {
                        star.classList.remove('bi-star');
                        star.classList.add('bi-star-fill');
                    } else {
                        star.classList.remove('bi-star-fill');
                        star.classList.add('bi-star');
                    }
                });
            });
        });
    });
</script>
@endif