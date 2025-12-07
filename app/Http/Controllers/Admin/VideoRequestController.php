<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoAccess;
use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;

class VideoRequestController extends Controller
{
    public function index()
    {
        $requests = VideoAccess::where('status', 'pending')
            ->with(['user', 'video'])
            ->latest()
            ->get();

        return view('admin.requests.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = VideoAccess::findOrFail($id);
        $request->status = 'approved';
        $request->end_time = now()->addHours(24); // akses 24 jam
        $request->save();

        return back()->with('success', 'Permintaan berhasil disetujui!');
    }

    public function reject($id)
    {
        $request = VideoAccess::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return back()->with('success', 'Permintaan ditolak!');
    }
}
