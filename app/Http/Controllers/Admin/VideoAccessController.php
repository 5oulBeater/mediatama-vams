<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoAccess;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VideoAccessController extends Controller
{
    public function index()
    {
        $requests = VideoAccess::with(['user', 'video'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.requests.index', compact('requests'));
    }

    public function approve(Request $request, $id)
    {
        $access = VideoAccess::findOrFail($id);

        // Hitung end_time berdasarkan durasi
        if ($request->duration === 'manual') {
            $endTime = Carbon::parse($request->manual_time);
        } else {
            $hours = (int)$request->duration;
            $endTime = Carbon::now()->addHours($hours);
        }

        $access->update([
            'status' => 'approved',
            'start_time' => Carbon::now(),
            'end_time' => $endTime
        ]);

        return redirect()->route('admin.requests.index')
            ->with('success', 'Akses berhasil disetujui');
    }

    public function reject($id)
    {
        $access = VideoAccess::findOrFail($id);
        $access->update(['status' => 'rejected']);

        return redirect()->route('admin.requests.index')
            ->with('success', 'Akses berhasil ditolak');
    }
}
