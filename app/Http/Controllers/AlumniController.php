<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Mail\SendMail;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $emailSubject = "Subject Email yang Dinamis";
        // $emailContent = "mail.mail_alumni_code"; // Nama view untuk konten email
        // $email = new SendMail($emailSubject, $emailContent);
        // Mail::to('febririzqitn@gmail.com')->send($email);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'alumni_name' => 'required|string|max:255',
            'alumni_tahun_ajaran1' => 'required|integer',
            'alumni_tahun_ajaran2' => 'required|integer',
            'alumni_jurusan' => 'required|string|max:255',
            'alumni_email' => 'required|email|max:255',
            'alumni_kegiatan' => 'required|string|max:255',
            'alumni_keterangan' => 'required|string|max:255',
            'alumni_image' => 'required|image|max:5048',
        ]);
        

        $angka_acak = mt_rand(100000, 999999);
        // Proses menyimpan data alumni ke dalam database
        $emailData = [
            'alumni_name' => $request->alumni_name,
            'alumni_code' => $angka_acak,
            'alumni_jurusan' => $request->alumni_jurusan,
            'alumni_kegiatan' => $request->alumni_kegiatan,
            'alumni_keterangan' => $request->alumni_keterangan,
            'alumni_subject' => 'Form Pendataan Alumni'
        ];

        $imageName = time().'.'.$request->alumni_image->extension();
        $request->alumni_image->move(public_path('alumni_image'), $imageName);


        $alumni = new Alumni();
        $alumni->alumni_name = $request->alumni_name;
        $alumni->alumni_tahun_ajaran1 = $request->alumni_tahun_ajaran1;
        $alumni->alumni_tahun_ajaran2 = $request->alumni_tahun_ajaran2;
        $alumni->alumni_jurusan = $request->alumni_jurusan;
        $alumni->alumni_email = $request->alumni_email;
        $alumni->alumni_kegiatan = $request->alumni_kegiatan;
        $alumni->alumni_keterangan = $request->alumni_keterangan;
        $alumni->alumni_passpharse = $angka_acak;
        $alumni->alumni_image = $imageName;
        $alumni->alumni_status = 0;

        $alumni->save();

        $emailSubject = "Registrasi Alumni SMK Krian 1 Sidoarjo";
        $emailContent = "mail.mail_alumni_code"; // Nama view untuk konten email
        $email = new SendMail($emailSubject, $emailContent, $emailData);
        Mail::to($request->alumni_email)->send($email);

        return response()->json([
            'status' => 200,
            'message' => 'Data alumni berhasil disimpan. periksa kode yang dikirim melalui email anda untuk memberikan ulasan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumni $alumni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumni)
    {
        //
    }
}
