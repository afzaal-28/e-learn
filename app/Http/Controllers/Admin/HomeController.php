<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Home');
    }
    public function getPermissions()
{
    $admin = Auth::guard('admin')->user();
    return response()->json($admin->permissions());
}
}
