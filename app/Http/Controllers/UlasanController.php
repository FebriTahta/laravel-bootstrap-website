<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Validator;
use App\Models\Alumni;
use Illuminate\Http\Request;

class UlasanController extends Controller
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
        $messages = [
            'deskripsi_ulasan.max' => 'Deskripsi ulasan tidak boleh melebihi 120 karakter.', // Pesan validasi kustom
        ];
        $validatedData = Validator::make($request->all(), [
            'deskripsi_ulasan' => 'required|max:120',
            'stars' => 'required|integer',
        ], $messages);

        if ($validatedData->fails()) {
            
            return response()->json(['status'=>400,'message' => $validatedData->errors()->all()]);
        
        } else {

            $alumni_exist = Alumni::where('alumni_email', $request->alumni_email)
            ->where('alumni_passpharse', $request->alumni_passpharse)
            ->first();
    
            if ($alumni_exist) {
                # code...
                if ($alumni_exist->ulasan !== null) {
                    # code...
                    $status = ($alumni_exist->alumni_status == 1) ? 'tampil' : 'menunggu review';
                    return response()->json([
                        'status' => 400,
                        'message' => 'Halo, '.$alumni_exist->alumni_name.' anda sudah memberikan ulasan. status ulasan anda :'.$status
                    ]);
                }else {
                    # code...
                    Ulasan::create([
                        'alumni_id' => $alumni_exist->id,
                        'deskripsi_ulasan' => $request->deskripsi_ulasan,
                        'rating_ulasan' => $request->stars
                    ]);
                    return response()->json([
                        'status' => 200,
                        'message' => 'ulasan berhasil diberikan, ulasan dan data anda akan di review terlebih dahulu oleh petugas terkait'
                    ]);
                }
                
            }else {
                # code...
                return response()->json([
                    'status' => 400,
                    'message' => 'Periksa kembali email & code anda, pastikan keduanya benar'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ulasan $ulasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ulasan $ulasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ulasan $ulasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ulasan $ulasan)
    {
        //
    }
}
