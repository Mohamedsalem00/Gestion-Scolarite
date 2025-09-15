<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard or redirect based on user role.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        // Redirect users to their appropriate dashboard based on role
        if ($user->isEnseignant()) {
            return redirect()->route('enseignant.tableau-bord');
        }
        
        // Admins see the main dashboard
        if ($user->isAdmin()) {
            return view('home');
        }
        
        // Fallback (should not happen with proper middleware)
        return redirect()->route('accueil');
    }
}
