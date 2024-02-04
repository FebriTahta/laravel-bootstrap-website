<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
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
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, File $file, $id)
    {
        if ($request->ajax()) {
            # code...
            try {
                $file = File::findOrFail($id);
                $filePath = public_path('file_ebook/' . $file->file_name);
            
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            
                $file->delete();
            
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
