<?php
// app/Http/Controllers/Admin/UserStatsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserStatsController extends Controller
{
    public function index()
    {
        $totalUsers = DB::table('users')->count(); // Fetch the total count of users
        
        return response()->json([
            'totalUsers' => $totalUsers,
        ]);
    }
}
