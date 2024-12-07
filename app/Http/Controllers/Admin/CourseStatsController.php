<?php
// app/Http/Controllers/Admin/CourseStatsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CourseStatsController extends Controller
{
    public function index()
    {
        
        $totalCourses = DB::table('courses')->count(); // Fetch the total count courses
        
        return response()->json([
            'totalCourses' => $totalCourses,
        ]);
    }
}
