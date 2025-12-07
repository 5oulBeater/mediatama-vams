<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoAccess;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pending = VideoAccess::where('status', 'pending')->count();
        $approved = VideoAccess::where('status', 'approved')->count();
        $rejected = VideoAccess::where('status', 'rejected')->count();

        return view('admin.dashboard', compact('pending', 'approved', 'rejected'));
    }
}
