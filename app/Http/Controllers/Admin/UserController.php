<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerDetail;

class UserController extends Controller
{
    /**
     * Display a listing of customer users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = CustomerDetail::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the details of a single user (optional).
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = CustomerDetail::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
}
