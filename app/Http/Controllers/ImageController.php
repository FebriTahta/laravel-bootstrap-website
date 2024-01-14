<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Image $image, $id)
    {   
        if ($request->ajax()) {
            # code...
            try {
                $image = Image::findOrFail($id);
                $imagePath = public_path('images_another/' . $image->image_name);
            
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            
                $image->delete();
            
                return response()->json([
                    'status' => 200,
                    'message' => 'Gambar berhasil dihapus'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }        
        }else {
            return 'ok';
        }
        
    }
}
