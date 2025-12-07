<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\VideoAccess;
use Illuminate\Support\Facades\Auth;

class CustomerHistoryController extends Controller
{
    public function index()
    {
        $history = VideoAccess::with('video')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.history.index', compact('history'));
    }
}
