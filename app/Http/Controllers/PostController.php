<?php

namespace App\Http\Controllers;
use App\Models\Konten;
use App\Models\Post;
use App\Models\Image;
use App\Models\Kategori;
use App\Models\File;
use Illuminate\Support\Str;
use Validator;
use DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->tipe == 'posting') {
            $data = Post::orderBy('id','desc')->with(['kategori','konten'])->paginate(5);
            return response()->json([
                'status' => 200,
                'message' => 'load posting data',
                'data_posting' => $data
            ]);
        }
        $title  = 'POSTING';
        $konten = Konten::where('konten_status', 1)->orderBy('id','desc')->get(); 
        return view('backend.post.index',compact('title','konten'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($konten_id)
    {
        $konten_id = base64_decode($konten_id);
        $title = 'CREATE POSTING';
        $konten = Konten::findOrFail($konten_id);
        $kategori = Kategori::where('kategori_status', 1)->orderBy('id','desc')->get();
        $action = 'create';
        return view('backend.post.create',compact('title','konten','kategori','action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'konten_id.required' => 'Field Konten Id harus diisi',
            'post_title.required' => 'Field  post title  harus diisi',
            'post_title.regex' => 'Field post title cannot contain html tag!',
            'post_status.required' => 'Field  post status  harus diisi',
            'post_desc.required' => 'Field  post deskripsi  harus diisi',
            'images.*.max' => 'Field another image harus kurang dari 2mb',
            'images.*.mimes' => 'Field another image harus berupa gambar',
            'post_thumb.max' => 'Field  post thumbnail  harus kurang dari 2mb',
            'post_thumb.mimes' => 'Field  post thumbnail  harus berupa gambar',
            'post_thumb.required' => 'Field  post thumbnail  harus diisi',
            'kategori_id.required' => 'Pilih minimal 1 kategori / maksimal 3 kategori',
            'file.max' => 'Field file harus kurang dari 2mb',
            'file.*.mimes' => 'Field File harus berupa file',
            
        ];
        $validator = Validator::make($request->all(), [
            'konten_id' => 'required',
            'post_title' => 'required|regex:/^[^<>]+$/',
            'post_status' => 'required',
            'post_desc' => 'required',
            'post_thumb' => 'required|mimes:jpeg,jpg,png,webp,svg,ico,gif,bmp,tiff,tif|max:2000',
            'images.*' => 'mimes:jpeg,jpg,png,webp,svg,ico,gif,bmp,tiff,tif|max:2000',
            'kategori_id' => 'required',
            'file.*' => 'mimes:pdf,doc,docx,xls,csv|max:2000'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['status'=>400,'message' => $validator->errors()->all()]);
        } else {
            DB::beginTransaction();
            try {
                $imageName = time().'.'.$request->post_thumb->extension();
                $request->post_thumb->move(public_path('images_thumbnail'), $imageName);

                $posting = Post::create([
                    'konten_id' => $request->konten_id,
                    'post_title' => $request->post_title,
                    'post_slug' => Str::slug($request->post_title),
                    'post_status' => $request->post_status,
                    'post_desc' => $request->post_desc,
                    'post_thumb' => $imageName,
                    'post_view' => 0
                ]);

                $posting->kategori()->attach($request->kategori_id);

                if ($request->images) {
                    # code...
                    $data_img = [];

                    foreach ($request->images as $key => $value) {
                        if ($value->isValid()) {
                            $size = $value->getSize();
                            $imageName = time() . '_' . $key . '.' . $value->extension();
                            $value->move(public_path('images_another'), $imageName);
                    
                            if ($value->getError()) {
                                // Tampilkan pesan kesalahan
                                dd($value->getErrorMessage());
                            }
                            
                            // Dapatkan tipe dan ukuran gambar
                            $imagePath = public_path('images_another') . '/' . $imageName;
                            list($width, $height, $imageType) = getimagesize($imagePath);
                    
                            // Simpan data gambar ke dalam array
                            $data_img[] = [
                                'image_name' => $imageName,
                                'image_link' => 'images_another/' . $imageName,
                                'image_type' => $imageType,
                                'image_size' => $size, // Ukuran file dalam bytes
                                'imageable_type' => Post::class,
                                'imageable_id' => $posting->id
                            ];
                        }
                    }                

                    Image::insert($data_img);
                }

               


                if ($request->konten_model == 4) {
                    if ($request->file) {
                        if ($request->file->isValid()) {
                            $size = $request->file->getSize();
                            $file_name = time() . '_' .$request->file->getClientOriginalName();
                            $request->file->move(public_path('file_ebook'), $file_name);
                            $fileable_type = Post::class;
                            $fileable_id = $posting->id;
                            File::create([
                                'file_name' => $file_name,
                                'file_size' => $size,
                                'fileable_type' => $fileable_type,
                                'fileable_id' => $fileable_id
                            ]);
                        }
                    }
                }else {
                    if ($request->file) {
                        foreach ($request->file as $key => $value) {
                            $size = $value->getSize();
                            $file_name = time() . '_' . $key . '.' . $value->getClientOriginalName();
                            $value->move(public_path('file_ebook'), $file_name);
                    
                            if ($value->getError()) {
                                // Tampilkan pesan kesalahan
                                dd($value->getErrorMessage());
                            }
                            
                            $fileable_type = Post::class;
                            $fileable_id = $posting->id;
                            $data_file[] = [
                                'file_name' => $file_name,
                                'file_size' => $size,
                                'fileable_type' => $fileable_type,
                                'fileable_id' => $fileable_id
                            ];
                        }   
                        File::insert($data_file);
                    }
                    
                }
                
                DB::commit();
                return Response()->json([
                    'status'  => 200,
                    'message' => 'Create new Post success'
                ]);
            } catch (\Throwable $e) {
                DB::rollback();
                return Response()->json([
                    'status' => 400,
                    'message'=> "Something Error",
                    'errors' => "Backend Error Pada Line" . $e->getMessage()
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, $id)
    {
        $id = base64_decode($id);
        $data = Post::where('id',$id)->with(['kategori','konten','image','file'])->first();
        $title = 'EDIT POSTING';
        $konten = Konten::findOrFail($data->konten_id);
        $kategori = Kategori::where('kategori_status', 1)->orderBy('id','desc')->get();
        $action = 'edit';
        $selectedCategories = [];
        foreach ($data->kategori as $key => $value) {
            $selectedCategories[] = $value->id;
        }
        return view('backend.post.edit',compact('data','title','konten','kategori','action','selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, $id)
    {
        $messages = [
            'konten_id.required' => 'Field Konten Id harus diisi',
            'post_title.required' => 'Field  post title  harus diisi',
            'post_status.required' => 'Field  post status  harus diisi',
            'post_desc.required' => 'Field  post deskripsi  harus diisi',
            'images.*.max' => 'Field another image harus kurang dari 2mb',
            'images.*.mimes' => 'Field another image harus berupa gambar',
            'post_thumb.max' => 'Field  post thumbnail  harus kurang dari 2mb',
            'post_thumb.mimes' => 'Field  post thumbnail  harus berupa gambar',
            'kategori_id.required' => 'Pilih minimal 1 kategori / maksimal 3 kategori'
        ];
        $validator = Validator::make($request->all(), [
            'konten_id' => 'required',
            'post_title' => 'required',
            'post_status' => 'required',
            'post_desc' => 'required',
            'post_thumb' => 'mimes:jpeg,jpg,png|max:2000',
            'images.*' => 'mimes:jpeg,jpg,png|max:2000',
            'kategori_id' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['status'=>400,'message' => $validator->errors()->all()]);
        } else {
            DB::beginTransaction();
            try {
                
                $posting = Post::where('id', $id)->first();

                if ($request->post_thumb) {
                    # jika ada hapus dulu image yang sudah ada di direktori code...
                    $imagePath = public_path('images_thumbnail/' . $posting->post_thumb);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    $imageName = time().'.'.$request->post_thumb->extension();
                    $request->post_thumb->move(public_path('images_thumbnail'), $imageName);
                    $posting->update([
                        'konten_id' => $request->konten_id,
                        'post_title' => $request->post_title,
                        'post_slug' => Str::slug($request->post_title),
                        'post_status' => $request->post_status,
                        'post_desc' => $request->post_desc,
                        'post_thumb' => $imageName,
                    ]);
                }else {
                    # update without image thumbnail replacing code...
                    $posting->update([
                        'konten_id' => $request->konten_id,
                        'post_title' => strtolower($request->post_title),
                        'post_slug' => Str::slug($request->post_title),
                        'post_status' => $request->post_status,
                        'post_desc' => $request->post_desc,
                    ]);
                }

                $posting->kategori()->sync($request->kategori_id);

                $data_img = [];

                if ($request->images) {
                    # code...
                    foreach ($request->images as $key => $value) {
                        if ($value->isValid()) {
                            $size = $value->getSize();
                            $imageName = time() . '_' . $key . '.' . $value->extension();
                            $value->move(public_path('images_another'), $imageName);
                    
                            if ($value->getError()) {
                                // Tampilkan pesan kesalahan
                                dd($value->getErrorMessage());
                            }
                            
                            // Dapatkan tipe dan ukuran gambar
                            $imagePath = public_path('images_another') . '/' . $imageName;
                            list($width, $height, $imageType) = getimagesize($imagePath);
                    
                            // Simpan data gambar ke dalam array
                            $data_img[] = [
                                'image_name' => $imageName,
                                'image_link' => 'images_another/' . $imageName,
                                'image_type' => $imageType,
                                'image_size' => $size, // Ukuran file dalam bytes
                                'imageable_type' => Post::class,
                                'imageable_id' => $posting->id
                            ];
                        }
                    }                
    
                    Image::insert($data_img);
                }

                if ($request->file) {
                    if ($request->file->isValid()) {
                        $size = $request->file->getSize();
                        $file_name = time() . '_' .$request->file->getClientOriginalName();
                        $request->file->move(public_path('file_ebook'), $file_name);

                        if ($posting->file->count() > 0) {
                            # edit code...
                            $filepath = public_path('file_ebook/' . $posting->file[0]->file_name);
                            if (file_exists($filepath)) {
                                unlink($filepath);
                            }
                            File::where('id', $posting->file[0]->id)->update([
                                'file_name' => $file_name,
                                'file_size' => $size,
                            ]);
                        }else {
                            # create code...
                            $fileable_type = Post::class;
                            $fileable_id = $posting->id;
                            File::create([
                                'file_name' => $file_name,
                                'file_size' => $size,
                                'fileable_type' => $fileable_type,
                                'fileable_id' => $fileable_id
                            ]);
                        } 
                    }
                }
                
                DB::commit();
                return Response()->json([
                    'status'  => 200,
                    'message' => 'update post '.$request->post_title.' success'
                ]);
            } catch (\Throwable $e) {
                DB::rollback();
                return Response()->json([
                    'status' => 400,
                    'message'=> "Something Error",
                    'errors' => "Backend Error Pada Line" . $e->getMessage()
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, $id)
    {
        // $id = base64_decode($id);
        $data = Post::where('id',$id)->with(['kategori','konten','image'])->first();
        DB::beginTransaction();
        try {
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
            $data->delete();

            DB::commit();
            return Response()->json([
                'status'  => 200,
                'message' => 'update post '.$post_title.' has been deleted'
            ]);

        } catch (\Throwable $e) {
            DB::rollback();
            return Response()->json([
                'status' => 400,
                'message'=> "Something Error",
                'errors' => "Backend Error Pada Line" . $e->getMessage()
            ]);
        }
    }
}
