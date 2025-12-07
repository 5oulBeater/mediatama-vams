<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoRequest;
use App\Models\VideoAccess;
use Illuminate\Http\Request;

class AdminRequestController extends Controller
{
    public function index()
    {
        $requests = VideoRequest::with(['user','video'])->latest()->get();
        return view('admin.requests.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = VideoRequest::findOrFail($id);
        $request->update(['status' => 'approved']);

        VideoAccess::create([
            'user_id' => $request->user_id,
            'video_id' => $request->video_id,
            'status' => 'approved'
        ]);

        return back()->with('success', 'Request approved successfully!');
    }

    public function reject($id)
    {
        $request = VideoRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Request rejected.');
    }
}
