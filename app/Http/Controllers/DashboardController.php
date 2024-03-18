<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Kategori;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Dashboard';
        $total_post_aktif = Post::where('post_status',1)->orderBy('id','desc')->count();
        $total_kategori_aktif = Kategori::where('kategori_status','1')->with('post')->orderBy('id','desc')->get();
        $profile = Profile::with('image')->first();
        return view('backend.dashboard.index', compact('title','total_post_aktif','total_kategori_aktif','profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
