<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Image;
use DB;
use Validator;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "SETTING";
        $profile = Profile::first();
        return view('backend.setting.index',compact('title','profile'));
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
        $messages = [
            'profile_name.required' => 'Field  profile name  harus diisi',
            'profile_title.required' => 'Field  profile title  harus diisi',
            'profile_subtitle.required' => 'Field  profile subtitle  harus diisi',
            'profile_thumb.max' => 'Field  profile thumbnail  harus kurang dari 1mb',
            'profile_thumb.mimes' => 'Field  profile thumbnail  harus berupa gambar',
            // 'profile_thumb.required' => 'Field  profile thumbnail  harus diisi',
            'profile_logo.max' => 'Field  profile logo harus kurang dari 1mb',
            'profile_logo.mimes' => 'Field  profile logo harus berupa gambar',
            // 'profile_logo.required' => 'Field  profile logo harus diisi',
            'profile_badge.required' => 'Field profile badge harus diisi',
            'profile_link1.required' => 'Field profile link 1 harus diisi',
            'profile_heroimage.max' => 'Field  profile heroimage harus kurang dari 1mb',
            'profile_heroimage.mimes' => 'Field  profile heroimage harus berupa gambar',
            // 'profile_heroimage.required' => 'Field  profile heroimage harus diisi',
            'profile_herotitle.required' => 'Field  profile herotitle harus diisi',
            'profile_herosubtitle.required' => 'Field  profile herosubtitle harus diisi',
            'profile_herodesc.required' => 'Field  profile herodesc harus diisi',
            'profile_contactnumber.required' => 'Field contact number harus diisi',
            'profile_featuretitle.required' => 'Field feature title harus diisi',
            'profile_featuredesc.required' => 'Field feature desc harus diisi',
            'profile_featurelink.required' => 'Field feature link harus diisi',
            'images.*.max' => 'Field another image harus kurang dari 10mb',
            'images.*.mimes' => 'Field another image harus berupa gambar / video dengan format mkv atau mp4',
            'images.*.required' => 'Field another image harus diisi minimal 1 dan maksimal 3',
            'profile_address.required' => 'Field address harus diisi',
            'profile_email.required' => 'Field email harus diisi',
            'profile_maplang.required' => 'Field map longitude harus diisi',
            'profile_maplat.required' => 'Field map latitude harus diisi',
            'profile_address.max' => 'Field address maksimal 255 karakter'
        ];
        $validator = Validator::make($request->all(), [
            'profile_name' => 'required',
            'profile_title' => 'required',
            'profile_subtitle' => 'required',
            'profile_thumb' => 'mimes:jpeg,jpg,png,webp,svg,ico,gif,bmp,tiff,tif|max:1000',
            'profile_logo' => 'mimes:jpeg,jpg,png,webp,svg,ico,gif,bmp,tiff,tif|max:1000',
            'profile_badge' => 'required',
            'profile_link1' => 'required',
            'profile_heroimage' => 'mimes:jpeg,jpg,png,webp,svg,ico,gif,bmp,tiff,tif|max:1000',
            'profile_herotitle' => 'required',
            'profile_herosubtitle' => 'required',
            'profile_herodesc' => 'required',
            'profile_contactnumber' => 'required',
            'profile_featuretitle' => 'required',
            'profile_featuredesc' => 'required',
            'profile_featurelink' => 'required',
            'profile_address' => 'required|max:255',
            'profile_email' => 'required',
            'profile_maplong' => 'required',
            'profile_maplat' => 'required',
            'images.*' => 'required|mimes:jpeg,jpg,png,webp,svg,ico,gif,bmp,tiff,tif,mp4,mkv|max:10000',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['status'=>400,'message' => $validator->errors()->all()]);
        } else {
            DB::beginTransaction();
            try {

                if ($request->id) {
                    $exist = Profile::find($request->id);
                    // Jika metode edit 
                    // apakah sebelumnya ada gambar thumbnail dan selanjutnya ada request gambar thumbnail ?
                    if ($exist->profile_thumb && $request->profile_thumb) {
                        $imageThumb = public_path('images_profile/' . $exist->profile_thumb);
                        if (file_exists($imageThumb)) {
                            unlink($imageThumb);
                        }
                    }

                    // apakah sebelumnya ada gambar logo dan selanjutnya ada request gambar logo ?
                    if ($exist->profile_logo && $request->profile_logo) {
                        $imageLogo = public_path('images_profile/' . $exist->profile_logo);
                        if (file_exists($imageLogo)) {
                            unlink($imageLogo);
                        }
                    }

                    // apakah sebelumnya ada gambar heroimage dan selanjutnya ada request gambar heroimage ?
                    if ($exist->profile_heroimage && $request->profile_heroimage) {
                        $imageHeroimage = public_path('images_profile/' . $exist->profile_heroimage);
                        if (file_exists($imageHeroimage)) {
                            unlink($imageHeroimage);
                        }
                    }
                }

                $imageName = '';
                $imageName2= '';
                $imageName3= '';
                
                if ($request->profile_thumb) {
                    # code...
                    $imageName = time().'1.'.$request->profile_thumb->extension();
                    $request->profile_thumb->move(public_path('images_profile'), $imageName);
                }

                if ($request->profile_logo) {
                    # code...
                    $imageName2 = time().'2.'.$request->profile_logo->extension();
                    $request->profile_logo->move(public_path('images_profile'), $imageName2);
                }

                if ($request->profile_heroimage) {
                    # code...
                    $imageName3 = time().'3.'.$request->profile_heroimage->extension();
                    $request->profile_heroimage->move(public_path('images_profile'), $imageName3);
                }
                
                $data_update = [];
                if ($request->profile_thumb !== null && $request->profile_logo == null && $request->profile_heroimage == null) {
                    $data_update = [
                        'profile_name' => $request->profile_name,
                        'profile_title' => $request->profile_title,
                        'profile_subtitle' => $request->profile_subtitle,
                        'profile_thumb' => $imageName,
                        'profile_badge' => $request->profile_badge,
                        'profile_link1' => $request->profile_link1,
                        'profile_herotitle' => $request->profile_herotitle,
                        'profile_herosubtitle' => $request->profile_herosubtitle,
                        'profile_herodesc' => $request->profile_herodesc,
                        'profile_contactnumber' => $request->profile_contactnumber,
                        'profile_featuretitle' => $request->profile_featuretitle,
                        'profile_featuredesc' => $request->profile_featuredesc,
                        'profile_featurelink' => $request->profile_featurelink,
                        'profile_address' => $request->profile_address,
                        'profile_email' => $request->profile_email,
                        'profile_maplong' => $request->profile_maplong,
                        'profile_maplat' => $request->profile_maplat,
                    ];
                }elseif ($request->profile_thumb !== null && $request->profile_logo !== null && $request->profile_heroimage == null) {
                    $data_update = [
                        'profile_name' => $request->profile_name,
                        'profile_title' => $request->profile_title,
                        'profile_subtitle' => $request->profile_subtitle,
                        'profile_thumb' => $imageName,
                        'profile_logo' => $imageName2,
                        'profile_badge' => $request->profile_badge,
                        'profile_link1' => $request->profile_link1,
                        'profile_herotitle' => $request->profile_herotitle,
                        'profile_herosubtitle' => $request->profile_herosubtitle,
                        'profile_herodesc' => $request->profile_herodesc,
                        'profile_contactnumber' => $request->profile_contactnumber,
                        'profile_featuretitle' => $request->profile_featuretitle,
                        'profile_featuredesc' => $request->profile_featuredesc,
                        'profile_featurelink' => $request->profile_featurelink,
                        'profile_address' => $request->profile_address,
                        'profile_email' => $request->profile_email,
                        'profile_maplong' => $request->profile_maplong,
                        'profile_maplat' => $request->profile_maplat,
                    ];
                }elseif ($request->profile_thumb !== null && $request->profile_logo !== null && $request->profile_heroimage !== null) {
                    $data_update = [
                        'profile_name' => $request->profile_name,
                        'profile_title' => $request->profile_title,
                        'profile_subtitle' => $request->profile_subtitle,
                        'profile_thumb' => $imageName,
                        'profile_logo' => $imageName2,
                        'profile_heroimage' => $imageName3,
                        'profile_badge' => $request->profile_badge,
                        'profile_link1' => $request->profile_link1,
                        'profile_herotitle' => $request->profile_herotitle,
                        'profile_herosubtitle' => $request->profile_herosubtitle,
                        'profile_herodesc' => $request->profile_herodesc,
                        'profile_contactnumber' => $request->profile_contactnumber,
                        'profile_featuretitle' => $request->profile_featuretitle,
                        'profile_featuredesc' => $request->profile_featuredesc,
                        'profile_featurelink' => $request->profile_featurelink,
                        'profile_address' => $request->profile_address,
                        'profile_email' => $request->profile_email,
                        'profile_maplong' => $request->profile_maplong,
                        'profile_maplat' => $request->profile_maplat,
                    ];
                }elseif ($request->profile_thumb == null && $request->profile_logo == null && $request->profile_heroimage !== null) {
                    $data_update = [
                        'profile_name' => $request->profile_name,
                        'profile_title' => $request->profile_title,
                        'profile_subtitle' => $request->profile_subtitle,
                        'profile_heroimage' => $imageName3,
                        'profile_badge' => $request->profile_badge,
                        'profile_link1' => $request->profile_link1,
                        'profile_herotitle' => $request->profile_herotitle,
                        'profile_herosubtitle' => $request->profile_herosubtitle,
                        'profile_herodesc' => $request->profile_herodesc,
                        'profile_contactnumber' => $request->profile_contactnumber,
                        'profile_featuretitle' => $request->profile_featuretitle,
                        'profile_featuredesc' => $request->profile_featuredesc,
                        'profile_featurelink' => $request->profile_featurelink,
                        'profile_address' => $request->profile_address,
                        'profile_email' => $request->profile_email,
                        'profile_maplong' => $request->profile_maplong,
                        'profile_maplat' => $request->profile_maplat,
                    ];
                }elseif ($request->profile_thumb == null && $request->profile_logo !== null && $request->profile_heroimage !== null) {
                    $data_update = [
                        'profile_name' => $request->profile_name,
                        'profile_title' => $request->profile_title,
                        'profile_subtitle' => $request->profile_subtitle,
                        'profile_logo' => $imageName2,
                        'profile_heroimage' => $imageName3,
                        'profile_badge' => $request->profile_badge,
                        'profile_link1' => $request->profile_link1,
                        'profile_herotitle' => $request->profile_herotitle,
                        'profile_herosubtitle' => $request->profile_herosubtitle,
                        'profile_herodesc' => $request->profile_herodesc,
                        'profile_contactnumber' => $request->profile_contactnumber,
                        'profile_featuretitle' => $request->profile_featuretitle,
                        'profile_featuredesc' => $request->profile_featuredesc,
                        'profile_featurelink' => $request->profile_featurelink,
                        'profile_address' => $request->profile_address,
                        'profile_email' => $request->profile_email,
                        'profile_maplong' => $request->profile_maplong,
                        'profile_maplat' => $request->profile_maplat,
                    ];
                }elseif ($request->profile_thumb !== null && $request->profile_logo == null && $request->profile_heroimage !== null) {
                    $data_update = [
                        'profile_name' => $request->profile_name,
                        'profile_title' => $request->profile_title,
                        'profile_subtitle' => $request->profile_subtitle,
                        'profile_thumb' => $imageName,
                        'profile_heroimage' => $imageName3,
                        'profile_badge' => $request->profile_badge,
                        'profile_link1' => $request->profile_link1,
                        'profile_herotitle' => $request->profile_herotitle,
                        'profile_herosubtitle' => $request->profile_herosubtitle,
                        'profile_herodesc' => $request->profile_herodesc,
                        'profile_contactnumber' => $request->profile_contactnumber,
                        'profile_featuretitle' => $request->profile_featuretitle,
                        'profile_featuredesc' => $request->profile_featuredesc,
                        'profile_featurelink' => $request->profile_featurelink,
                        'profile_address' => $request->profile_address,
                        'profile_email' => $request->profile_email,
                        'profile_maplong' => $request->profile_maplong,
                        'profile_maplat' => $request->profile_maplat,
                    ];
                } elseif ($request->profile_thumb == null && $request->profile_logo !== null && $request->profile_heroimage == null) {
                    $data_update = [
                        'profile_name' => $request->profile_name,
                        'profile_title' => $request->profile_title,
                        'profile_subtitle' => $request->profile_subtitle,
                        'profile_logo' => $imageName2,
                        'profile_badge' => $request->profile_badge,
                        'profile_link1' => $request->profile_link1,
                        'profile_herotitle' => $request->profile_herotitle,
                        'profile_herosubtitle' => $request->profile_herosubtitle,
                        'profile_herodesc' => $request->profile_herodesc,
                        'profile_contactnumber' => $request->profile_contactnumber,
                        'profile_featuretitle' => $request->profile_featuretitle,
                        'profile_featuredesc' => $request->profile_featuredesc,
                        'profile_featurelink' => $request->profile_featurelink,
                        'profile_address' => $request->profile_address,
                        'profile_email' => $request->profile_email,
                        'profile_maplong' => $request->profile_maplong,
                        'profile_maplat' => $request->profile_maplat,
                    ];
                }
                else {
                    $data_update = [
                        'profile_name' => $request->profile_name,
                        'profile_title' => $request->profile_title,
                        'profile_subtitle' => $request->profile_subtitle,
                        'profile_badge' => $request->profile_badge,
                        'profile_link1' => $request->profile_link1,
                        'profile_herotitle' => $request->profile_herotitle,
                        'profile_herosubtitle' => $request->profile_herosubtitle,
                        'profile_herodesc' => $request->profile_herodesc,
                        'profile_contactnumber' => $request->profile_contactnumber,
                        'profile_featuretitle' => $request->profile_featuretitle,
                        'profile_featuredesc' => $request->profile_featuredesc,
                        'profile_featurelink' => $request->profile_featurelink,
                        'profile_address' => $request->profile_address,
                        'profile_email' => $request->profile_email,
                        'profile_maplong' => $request->profile_maplong,
                        'profile_maplat' => $request->profile_maplat,
                    ];
                }

                $profile = Profile::updateOrCreate(
                    [
                        'id' => $request->id
                    ], $data_update);

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
                                'imageable_type' => Profile::class,
                                'imageable_id' => $profile->id
                            ];
                        }
                    }
                    Image::insert($data_img);
                }

                DB::commit();
                return Response()->json([
                    'status'  => 200,
                    'message' => 'Profile has been updated'
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
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
