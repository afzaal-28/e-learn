<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Semester;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::all();
        $semesters = Semester::all();
        
        return Inertia::render('Admin/Student/Index', [
            'students' => $students,
            'semesters' => $semesters,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); 
        return Inertia::render('Admin/Student/Edit', [
            'student' => $user, 
            'id' => $id,
        ]);
    }
    
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        DB::table('users')->where('id', $id)->delete();
        DB::table('semesters')->where('user_id', $id)->delete();
        return redirect()->route('student.index')->with('success', 'User and their semester record deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'level' => 'nullable|integer|min:1|max:8', 
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        if (isset($validated['level'])) {
            $semester = Semester::where('user_id', $id)->first();
    
            if ($semester) {
                $semester->update(['level' => $validated['level']]);
            } else {
                Semester::create([
                    'user_id' => $id,
                    'level' => $validated['level'],
                ]);
            }
        }
    
        return redirect()->route('student.index', $id)->with('success', 'Student details updated successfully.');
    }
    
}
