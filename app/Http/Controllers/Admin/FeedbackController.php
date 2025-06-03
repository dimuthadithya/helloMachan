<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with(['user', 'order.items.menuItem'])
            ->latest()
            ->paginate(10);

        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function approve(Feedback $feedback)
    {
        $feedback->update(['is_approved' => true]);
        return back()->with('success', 'Feedback approved successfully');
    }

    public function reject(Feedback $feedback)
    {
        $feedback->update(['is_approved' => false]);
        return back()->with('success', 'Feedback rejected successfully');
    }

    public function toggleFeatured(Feedback $feedback)
    {
        $feedback->update(['is_featured' => !$feedback->is_featured]);
        return back()->with('success', 'Featured status updated successfully');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Feedback deleted successfully');
    }
}
