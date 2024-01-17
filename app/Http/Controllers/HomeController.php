<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check() && Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin') {
            # code...
            return redirect()->to('/admin-dashboard');
        }else{
            // return view('home');
            return redirect()->to('/');
        }
        
    }
}
