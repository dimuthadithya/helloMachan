@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Customer Feedbacks</h4>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Customer</th>
                            <th>Order</th>
                            <th>Rating</th>
                            <th>Feedback</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($feedbacks as $feedback)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light p-2">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0">{{ $feedback->user->name }}</h6>
                                        <small class="text-muted">{{ $feedback->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>#{{ $feedback->order->order_number }}</td>
                            <td>
                                <div class="text-warning">
                                    @for($i = 0; $i < $feedback->rating; $i++)
                                        <i class="bi bi-star-fill"></i>
                                        @endfor
                                </div>
                            </td>
                            <td style="max-width: 300px;">
                                <p class="text-muted mb-0 text-truncate">{{ $feedback->comment }}</p>
                            </td>
                            <td>{{ $feedback->created_at->format('M d, Y') }}</td>
                            <td>
                                <form action="{{ route('admin.feedbacks.toggle-approval', $feedback) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm btn-{{ $feedback->is_approved ? 'success' : 'warning' }}">
                                        <i class="bi bi-{{ $feedback->is_approved ? 'check-circle' : 'x-circle' }}"></i>
                                        {{ $feedback->is_approved ? 'Approved' : 'Pending' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.feedbacks.toggle-featured', $feedback) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm btn-{{ $feedback->is_featured ? 'info' : 'light' }}">
                                        <i class="bi bi-star{{ $feedback->is_featured ? '-fill' : '' }}"></i>
                                        {{ $feedback->is_featured ? 'Featured' : 'Feature' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.feedbacks.destroy', $feedback) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this feedback?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <p class="text-muted mb-0">No feedbacks found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $feedbacks->links() }}
    </div>
</div>
@endsection