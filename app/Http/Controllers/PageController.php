<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Konten;
use App\Models\Profile;
use App\Models\Jurusan;
use App\Models\Alumni;
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
        
        if ($data->konten_model == 1) {
            # code...

            $post = Post::where('konten_id', $data->id)
            ->with(['kategori'])->first();
            $kategori = Kategori::whereHas('post', function ($q) use ($data) {
                $q->where('konten_id', $data->id);
            })->withCount('post')->get();
            return view('frontend.datalist',compact('data','post','kategori','search'));

        }else{
            # code...
            $post = Post::where('konten_id', $data->id)
                ->with(['kategori'])->orderBy('id','desc')
                ->paginate(12);
            $kategori = Kategori::whereHas('post', function ($q) use ($data) {
                $q->where('konten_id', $data->id);
            })->withCount('post')->get();
            return view('frontend.datalist',compact('data','post','kategori','search'));
        }
        
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

    public function registrasi_alumni(Request $request)
    {
        return view('frontend.registrasi_alumni');
    }

    public function alumni_search(Request $request)
    {
        $search = $request->get('search');
        $alumni = Alumni::with(['ulasan'])
        ->where('alumni_status', 1)
        ->where('alumni_name', 'LIKE' , '%'.$search.'%')
        ->orWhere('alumni_keterangan', 'LIKE', '%'.$search.'%')
        ->orWhere('alumni_kegiatan', 'LIKE', '%'.$search.'%')
        ->orderBy('alumni_tahun_ajaran2', 'desc')->paginate(12);

        $kategori = Alumni::select('alumni_kegiatan as kategori_name', DB::raw('COUNT(*) as total'))
        ->groupBy('alumni_kegiatan')
        ->get();

        return view('frontend.alumni',compact('kategori','search','alumni'));
    }

    public function alumni()
    {
        $search = null;

        $alumni = Alumni::with(['ulasan'])
        ->where('alumni_status', 1)
        ->orderBy('alumni_tahun_ajaran2', 'desc')->paginate(12);

        $kategori = Alumni::select('alumni_kegiatan as kategori_name', DB::raw('COUNT(*) as total'))
        ->groupBy('alumni_kegiatan')
        ->get();
        
        // return $alumni;
        return view('frontend.alumni',compact('kategori','search','alumni'));
    }

    public function ulasan()
    {
        return view('frontend.ulasan');
    }

    public static function v4() 
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }













    // PROSES BACKUP
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
    }
}
