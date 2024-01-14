<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Submenu;
use App\Models\Image;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->tipe == 'konten') {
            $konten = Konten::with('kontentable')->orderBy('id','desc')->paginate(5);
            return response()->json([
                'status' => 200,
                'message' => 'load konten data',
                'data_konten' => $konten
            ]);
        }
        $title = 'KONTEN';
        return view('backend.konten.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "CREATE NEW KONTEN";
        $menu = Menu::where('menu_status',1)->whereDoesntHave('submenu')->whereDoesntHave('konten')->get();
        $submenu = Submenu::where('submenu_status',1)->whereDoesntHave('konten')->get();
        return view('backend.konten.create',compact('menu','submenu','title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'konten_name'    => 'required|max:50|unique:kontens,konten_name',
            'konten_status'  => 'required',
            'parent_value'   => 'required',
            'konten_model'   => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Pastikan memilih menu / submenu & '.$validator->errors()->first())->with('input', $request->all());
        }else {
            $kontentable_type = '';
            // return $request->parent_id;
            if ($request->parent_option == 'menu') {
                $kontentable_type = Menu::class;
            }else {
                $kontentable_type = Submenu::class;
            }

            $konten = Konten::create([
                'konten_name' => strtolower($request->konten_name),
                'konten_slug' => Str::slug($request->konten_name),
                'konten_status' => $request->konten_status,
                'kontentable_type' => $kontentable_type,
                'kontentable_id' => $request->parent_value,
                'konten_model' => $request->konten_model
            ]);

            return redirect()->to('/admin-konten')->with('success','Konten '.$request->konten_name.' has been Added');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Konten $konten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Konten $konten, $id)
    {
        $title = "EDIT NEW KONTEN";
        $konten = Konten::where('id', $id)->with('kontentable')->first();
        $menu = Menu::where('menu_status',1)->whereDoesntHave('submenu')->whereDoesntHave('konten',function($q) use ($id) {
            $q->where('id', '<>', $id);
        })->get();
        $submenu = Submenu::where('submenu_status',1)->whereDoesntHave('konten',function($q) use ($id) {
            $q->where('id', '<>', $id);
        })->get();
        return view('backend.konten.edit',compact('menu','submenu','title','konten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Konten $konten, $id)
    {
        $validator = Validator::make($request->all(), [
            'konten_name'    => 'required|max:50',
            'konten_status'  => 'required',
            'parent_value'   => 'required',
            'konten_model'   => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Pastikan memilih menu / submenu & '.$validator->errors()->first())->with('input', $request->all());
        }else {
            $kontentable_type = '';
            // return $request->parent_id;
            if ($request->parent_option == 'menu') {
                $kontentable_type = Menu::class;
            }else {
                $kontentable_type = Submenu::class;
            }

            $konten = Konten::where('id', $id)->first();
            if ($konten->konten_name == strtolower($request->konten_name)) {
                $konten->update([
                    'konten_name' => strtolower($request->konten_name),
                    'konten_slug' => Str::slug($request->konten_name),
                    'konten_status' => $request->konten_status,
                    'kontentable_type' => $kontentable_type,
                    'kontentable_id' => $request->parent_value,
                    'konten_model' => $request->konten_model
                ]);

                return redirect()->to('/admin-konten')->with('success','Konten '.$request->konten_name.' has been updated');
            }else {
                if (empty(Konten::where('konten_name', strtolower($request->konten_name))->first())) {
                    $konten->update([
                        'konten_name' => strtolower($request->konten_name),
                        'konten_slug' => Str::slug($request->konten_name),
                        'konten_status' => $request->konten_status,
                        'kontentable_type' => $kontentable_type,
                        'kontentable_id' => $request->parent_value,
                        'konten_model' => $request->konten_model
                    ]);
                    return redirect()->to('/admin-konten')->with('success','konten '.$request->konten_name.' has been Updated');
                }else {
                    return redirect()->back()->with('error','Konten dengan nama tersebut telah terdaftar');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konten $konten, $id)
    {
        $konten = Konten::where('id',$id)->first(); // belum dihapus
        $datas = Post::where('konten_id',$id)->with(['kategori','konten','image'])->get(); // belum dihapus
        foreach ($datas as $key => $data) {
            $post_title= $data->post_title;
            $imagePath = public_path('images_thumbnail/' . $data->post_thumb);
            if (file_exists($imagePath)) {
                unlink($imagePath); // hapus thumbnail dari direktori
            }

            $image_id = [];
            foreach ($data->image as $key => $value) {
                $pathImages = public_path('images_another/' . $value->image_name);
                if (file_exists($pathImages)) {
                    unlink($pathImages); // hapus image dari direktori
                }

                $image_id[] = $value->id;
            }

            // remove image
            Image::whereIn('id', $image_id)->delete();
            $data->kategori()->detach();
        }

        Post::where('konten_id',$id)->delete();
        $konten->delete();

        return response()->json([
            'status'=>200,
            'message'=>'konten Post Telah dihapus'.$id
        ]);
    }
}
