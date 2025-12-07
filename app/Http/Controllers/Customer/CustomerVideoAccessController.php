<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\VideoAccess;
use Illuminate\Support\Facades\Auth;

class CustomerVideoAccessController extends Controller
{
    public function requestAccess($id)
    {
        // Cek apakah sudah pernah request sebelumnya agar tidak double
        $exists = VideoAccess::where('user_id', Auth::id())
            ->where('video_id', $id)
            ->where('status', '!=', 'rejected')
            ->first();

        if ($exists) {
            return back()->with('error', 'Permintaan untuk video ini sudah pernah dikirim atau sudah disetujui.');
        }

        VideoAccess::create([
            'user_id' => Auth::id(),
            'video_id' => $id,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Permintaan akses video berhasil dikirim. Tunggu persetujuan admin.');
    }
}
