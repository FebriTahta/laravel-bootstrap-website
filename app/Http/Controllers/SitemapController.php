<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use App\Models\Konten;
use App\Models\Post;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index(): Response 
    {
        // $post = Post::latest()->get();
        $data = Konten::whereHas('post')->latest()->get();
        return response()->view('sitemap', ['post'=>$data])->header('Content-Type','text/xml');
    }
}
