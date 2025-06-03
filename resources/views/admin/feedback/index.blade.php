@extends('admin.layouts.app')

@section('title', 'Customer Feedback')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="p-4 bg-white border-4 rounded shadow-sm border-start border-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">Customer Feedback</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="mb-0 breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Customer Feedback</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Feedback List -->
    <div class="row">
        <div class="col-12">
            <div class="p-4 bg-white rounded shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Customer</th>
                                <th>Order #</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Date</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($feedbacks as $feedback)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="p-2 rounded-circle bg-light">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $feedback->user->name }}</h6>
                                            <small class="text-muted">{{ $feedback->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $feedback->order) }}" class="text-decoration-none">
                                        #{{ $feedback->order->id }}
                                    </a>
                                </td>
                                <td>
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $feedback->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                    </div>
                                </td>
                                <td>{{ Str::limit($feedback->comment, 50) }}</td>
                                <td>
                                    @if($feedback->is_approved)
                                    <span class="badge bg-success">Approved</span>
                                    @else
                                    <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($feedback->is_featured)
                                    <span class="badge bg-info">Featured</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $feedback->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if(!$feedback->is_approved)
                                        <form action="{{ route('admin.feedback.approve', $feedback) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.feedback.reject', $feedback) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this feedback?')">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                        @endif
                                        <form action="{{ route('admin.feedback.toggle-featured', $feedback) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $feedback->is_featured ? 'btn-secondary' : 'btn-info' }}">
                                                <i class="bi bi-star{{ $feedback->is_featured ? '' : '-fill' }}"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="py-5 text-center">
                                    <i class="mb-3 bi bi-chat-dots display-4 text-secondary"></i>
                                    <p class="mb-0 text-secondary">No feedback found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection