<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Alumni;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // berita
        $hot_news = Post::where('konten_id', function ($q) {
            $q->select('id')
              ->from('kontens') 
              ->where('konten_slug', 'LIKE', '%berita%');
        })->orderBy('id','desc')->limit(3)->get();

        $profile = Profile::with(['image' => function($q){
            $q->orderBy('id','desc');
        }])->first();

        // prestasi
        $prestasi = Post::where('konten_id', function($q) {
            $q->select('id')
            ->from('kontens')
            ->where('konten_slug', 'LIKE', '%prestasi%');
        })->latest()->first();

        // ebook
        $ebook    = Post::where('konten_id',function($q){
            $q->select('id')
            ->from('kontens')
            ->where('konten_slug','LIKE', '%e-book%');
        }) ->orderBy('id','desc')->limit(2)->get();
        
        // guru
        $guru     = Post::where('konten_id', function($q){
            $q->select('id')
            ->from('kontens')
            ->where('konten_slug','LIKE','%guru%');
        })->orderBy('id','desc')->limit(6)->get();

        // artikel
        $artikel = Post::where('konten_id', function($q){
            $q->select('id')
            ->from('kontens')
            ->where('konten_slug','LIKE', '%artikel%');
        })->orderBy('id','desc')->limit(4)->get();

        $alumni = Alumni::where('alumni_status', 1)->with(['ulasan'])
        ->orderBy('id','desc')->limit(6)->get();

        $jurusan = Post::where('konten_id', function($q){
            $q->select('id')
            ->from('kontens')
            ->where('konten_slug','jurusan');
        })->get();

        $alumniLanjutan = Alumni::where('alumni_status', 1)
        ->with(['ulasan'])
        ->orderBy('id', 'desc')
        ->skip(6) // Melewati 6 data pertama
        ->limit(6) // Ambil 6 data berikutnya
        ->get();

        $general = Post::orderBy('id','desc')->limit(10)->get();

        $general2 = Post::where('id', '<', $general->last()->id)
        ->orderBy('id','desc')->limit(10)->get();

        return view('frontend.landing',compact('hot_news','profile','prestasi','ebook',
        'guru','artikel','general','alumni','alumniLanjutan','jurusan','general2'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
