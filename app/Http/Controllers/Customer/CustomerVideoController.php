<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerVideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();

        $approvedVideos = VideoAccess::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->where(function($q) {
                // pastikan end_time belum lewat (atau end_time is null -> still valid if you want)
                $q->whereNull('end_time')
                  ->orWhere('end_time', '>', now());
            })
            ->pluck('video_id')
            ->toArray();

        return view('customer.videos.index', compact('videos', 'approvedVideos'));
    }

    public function requestAccess($id)
    {
        $exists = VideoAccess::where('user_id', Auth::id())
            ->where('video_id', $id)
            ->where('status', 'pending')
            ->first();

        if ($exists) {
            return back()->with('error', 'Anda sudah mengirim permintaan untuk video ini.');
        }

        VideoAccess::create([
            'user_id' => Auth::id(),
            'video_id' => $id,
            'status' => 'pending',
            'start_time' => null,
            'end_time' => null,
        ]);

        return back()->with('success', 'Permintaan akses video berhasil dikirim.');
    }

    public function watch($id)
    {
        $video = Video::findOrFail($id);

        $access = VideoAccess::where('user_id', auth()->id())
            ->where('video_id', $id)
            ->where('status', 'approved')
            ->first();

        if (!$access) {
            return redirect()->route('customer.videos.index')
                ->with('error', 'Anda belum memiliki akses video.');
        }

        $endTimeIso = $access->end_time ? $access->end_time->toIso8601String() : null;

        return view('customer.videos.watch', compact('video', 'access', 'endTimeIso'));
    }
}
