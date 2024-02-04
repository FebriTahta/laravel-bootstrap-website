<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Konten;
use App\Models\Post;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MigrateBackup;
use App\Imports\MigrateBackupImport;
use DB;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function datalist(Request $request, $konten_slug)
    {
        $search = null;
        $data = Konten::where('konten_slug', $konten_slug)->withCount('post')->first();
        $post = Post::where('konten_id', $data->id)
                ->with(['kategori'])->orderBy('id','desc')
                ->paginate(12);
        $kategori = Kategori::whereHas('post', function ($q) use ($data) {
            $q->where('konten_id', $data->id);
        })->withCount('post')->get();
        return view('frontend.datalist',compact('data','post','kategori','search'));
    }

    public function search(Request $request, $konten_slug)
    {
        $search = $request->input('search');

        $data = Konten::where('konten_slug', $konten_slug)->withCount('post')->first();
        $post = Post::where('konten_id', $data->id)
            ->where(function ($query) use ($search) {
                $query->where('post_title', 'like', '%' . $search . '%')
                    ->orWhere('post_desc', 'like', '%' . $search . '%');
            })
            ->with(['kategori'])->orderBy('id','desc')
            ->paginate(12);

        $kategori = Kategori::whereHas('post', function ($q) use ($data, $search) {
            $q->where('konten_id', $data->id)
                ->where(function ($query) use ($search) {
                    $query->where('post_title', 'like', '%' . $search . '%')
                        ->orWhere('post_desc', 'like', '%' . $search . '%');
                });
        })
        ->withCount('post')
        ->get();

        return view('frontend.datalist',compact('data','post','kategori','search'));
    }

    public function detaildata($konten_slug, $post_slug)
    {
        $konten = Konten::where('konten_slug', $konten_slug)->first();
        $post = Post::where('post_slug', $post_slug)->with(['kategori','image','file'])
        ->withCount(['image','file'])->first();
        $next = Post::where('id', '<', $post->id)
        ->whereHas('konten', function($q) use ($konten_slug){
            $q->where('konten_slug', $konten_slug);
        })
        ->orderBy('id', 'desc')->first();
        if ($post->post_view == 5) {
            $post->update(['post_view'=> mt_rand(200,300)]);
        }else {
            $post->update(['post_view'=> $post->post_view + 1]);
        }
        
        return view('frontend.detaildata',compact('konten','post'));
    }

    public function global_search(Request $request)
    {
        $search = $request->get('search');
        $post = Post::where('post_slug','LIKE','%'.$search.'%')->paginate(12);
        $kategori = Kategori::whereHas('post', function($q) use ($search) {
            $q->where('post_title','LIKE','%'.$search.'%');
        })->withCount('post')
        ->get();
        return view('frontend.searchdata',compact('search','kategori','post'));
        // return $post;
    }

    public function migrate_backup()
    {
        return Excel::download(new MigrateBackup(), 'migrate_backup.xlsx');
    }

    public function backup()
    {
        return view('backup');
    }

    public function import(Request $request)
    {
        $file = $request->file('excel_file');
        Excel::import(new MigrateBackupImport, $file);
        // return $file;
        // $import = Excel::import(new MigrateBackupImport, $file);
        // return response()->json($file);
    }
}
