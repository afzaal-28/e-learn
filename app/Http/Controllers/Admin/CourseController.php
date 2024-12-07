<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    // Display a list of all courses
    public function index()
    {
        $url = 'https://autocomplete.clearbit.com/v1/companies/suggest?query=Deloitte';
        $response = Http::get($url);
        if ($response->successful()) {
            $data = $response->json();
            // dd($data);
        }
        $courses = Course::all();
        $admin = Auth::guard('admin')->user();
        return Inertia::render('Admin/Courses/Index', [
            'courses' => $courses,
            'permissions' => $admin->permissions(),
        ]);
    }

    // Show the form for creating a new course
    public function create()
    {
        return Inertia::render('Admin/Courses/Create');
    }

    // Store a newly created course in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'nullable|string|max:255', // Add duration
        'level' => 'nullable|string|max:255',
        ]);

        // Create a new course using the validated data
        Course::create($validated);

        // Redirect to the courses index page
        return redirect()->route('admin.courses.index');
    }

    // Show the form for editing the specified course
    public function edit(Course $course)
    {
        return Inertia::render('Admin/Courses/Edit', [
            'course' => $course,
        ]);
    }

    // Update the specified course in the database
    public function update(Request $request, Course $course)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'nullable|string|max:255', // Add duration
        'level' => 'nullable|string|max:255',  
        ]);

        // Update the course with the validated data
        $course->update($validated);

        // Redirect to the courses index page
        return redirect()->route('admin.courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index');
    }
    
    
}
