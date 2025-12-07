<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        return back()->with('success', 'Customer berhasil dihapus.');
    }
}
