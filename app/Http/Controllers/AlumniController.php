<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Models\Ulasan;
use DB;
use App\Mail\SendMail;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->tipe == 'alumni') {
            $data = Alumni::orderBy('id','desc')->with(['ulasan'])->paginate(5);
            return response()->json([
                'status' => 200,
                'message' => 'load alumni data',
                'data_posting' => $data
            ]);
        }
        return view('backend.alumni.index');
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
        $messages = [
            'alumni_image.max' => 'Tidak dapat menerima foto dengan ukuran lebih dari 5mb.', // Pesan validasi kustom
        ];

        try {
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
            ], $messages);
            
            // If validation passes, continue with the rest of the code
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

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->errors()
            ]);
        }
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
    public function edit(Alumni $alumni, $id)
    {
        $id = base64_decode($id);
        $alumni = Alumni::where('id',$id)->with(['ulasan'])->first();
        $title = 'REVIEW ALUMNI';
        $action = 'edit';
        
        return view('backend.alumni.edit',compact('alumni','title','action'));
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
    public function destroy(Alumni $alumni, $id)
    {
        $data = Alumni::where('id',$id)->with(['ulasan'])->first();
        DB::beginTransaction();

        try {
            $alumni_name= $data->alumni_name;
            $imagePath = public_path('alumni_image/' . $data->alumni_image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // hapus thumbnail dari direktori
            }
            Ulasan::where('alumni_id', $data->id)->delete();
            $data->delete();

            DB::commit();
            return Response()->json([
                'status'  => 200,
                'message' => $alumni_name.' has been deleted from alumni'
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

    public function audit_ulasan_alumni(Request $request)
    {
        $messages = [
            'deskripsi_ulasan.max' => 'Deskripsi ulasan tidak boleh melebihi 120 karakter.', // Pesan validasi kustom
        ];
        $validatedData = Validator::make($request->all(), [
            'alumni_name' => 'required|string|max:255',
            'alumni_tahun_ajaran1' => 'required|integer',
            'alumni_tahun_ajaran2' => 'required|integer',
            'alumni_jurusan' => 'required|string|max:255',
            'alumni_email' => 'required|email|max:255',
            'alumni_kegiatan' => 'required|string|max:255',
            'alumni_keterangan' => 'required|string|max:255',
            'alumni_image' => 'image|max:5048',
            'deskripsi_ulasan' => 'required|max:120',
            'stars' => 'required|integer',
            'alumni_id' => 'required',
            'stars' => 'required',
            'alumni_status' => 'required'
        ], $messages);

        if ($validatedData->fails()) {
            return response()->json(['status'=>400,'message' => $validatedData->errors()->all()]);
        } else {
            DB::beginTransaction();
            try {
                $data = null;
                $alumni_exist = Alumni::find($request->alumni_id);
                if ($request->alumni_image == null) {
                    # code...
                    $data = Alumni::updateOrCreate(
                        ['id' => $request->alumni_id],
                        [
                            'alumni_name' => $request->alumni_name,
                            'alumni_tahun_ajaran1' => $request->alumni_tahun_ajaran1,
                            'alumni_tahun_ajaran2' => $request->alumni_tahun_ajaran2,
                            'alumni_jurusan' => $request->alumni_jurusan,
                            'alumni_email' => $request->alumni_email,
                            'alumni_kegiatan' => $request->alumni_kegiatan,
                            'alumni_keterangan' => $request->alumni_keterangan,
                            'alumni_status' => $request->alumni_status,
                        ]
                    );
                }else {
                    # code...
                    $imagePath = public_path('alumni_image/' . $alumni_exist->alumni_image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath); // hapus thumbnail dari direktori
                    }

                    $imageName = time().'.'.$request->alumni_image->extension();
                    $request->alumni_image->move(public_path('alumni_image'), $imageName); // simpan image baru

                    $data = Alumni::updateOrCreate(
                        ['id' => $request->alumni_id],
                        [
                            'alumni_name' => $request->alumni_name,
                            'alumni_tahun_ajaran1' => $request->alumni_tahun_ajaran1,
                            'alumni_tahun_ajaran2' => $request->alumni_tahun_ajaran2,
                            'alumni_jurusan' => $request->alumni_jurusan,
                            'alumni_email' => $request->alumni_email,
                            'alumni_kegiatan' => $request->alumni_kegiatan,
                            'alumni_keterangan' => $request->alumni_keterangan,
                            'alumni_image' => $imageName,
                            'alumni_status' => $request->alumni_status
                        ]
                    );
                }

                Ulasan::updateOrCreate(
                    ['alumni_id' => $request->alumni_id],
                    [
                        'rating_ulasan' => $request->stars,
                        'deskripsi_ulasan' => $request->deskripsi_ulasan
                    ]
                );
                DB::commit();
                return Response()->json([
                    'status' => 200,
                    'message'=> "Data alumni berhasil diperbarui",
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
}
