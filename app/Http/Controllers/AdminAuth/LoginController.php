<?php
namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route; 
use Illuminate\Http\RedirectResponse;
use App\Providers\AppServiceProvider;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        if (Auth::guard('admin')->check()) {
            return Inertia::render('Admin/Home');
        }

        return Inertia::render('Admin/AdminAuth/Login', [
            'canResetPassword' => Route::has('password.request'), 
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication was successful
            $request->session()->regenerate();

            return redirect()->intended(AppServiceProvider::ADMIN_HOME);
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
