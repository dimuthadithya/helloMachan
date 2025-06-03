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

        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function toggleApproval(Feedback $feedback)
    {
        $feedback->update(['is_approved' => !$feedback->is_approved]);
        return back()->with('success', 'Feedback status updated successfully');
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
