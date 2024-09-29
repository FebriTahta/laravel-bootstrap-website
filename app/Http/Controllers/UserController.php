<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Credentials';
        return view('backend.users.index',compact('title'));
    }

    public function update(Request $request)
    {

         // Pengecekan role pengguna yang sedang login
        $user = auth()->user(); // Mendapatkan pengguna yang sedang login

        if ($user && $user->role !== 'admin') {
            // Jika pengguna yang login bukan admin, kembalikan respon error
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk memperbarui data pengguna.');
        }

        // Validasi input yang diperlukan
        $request->validate([
            'id' => 'required|exists:users,id', // Memastikan ID user ada di database
            'username' => 'required|string|max:255|regex:/^[a-zA-Z0-9_]+$/', // Validasi username dengan regex
            'password' => 'required|string|min:8', // Minimal 8 karakter untuk password
        ]);

        // Periksa apakah username dan password tidak null
        if ($request->username !== null && $request->password !== null) {
            // Cek apakah pengguna dengan ID tersebut ada
            $user = User::find($request->id);

            if ($user) {
                // Update data pengguna
                $update = $user->update([
                    'name' => $request->username,
                    // Hindari menyimpan password dalam bentuk plaintext (pass_vis)
                    'pass_vis' => $request->password,
                    'password' => Hash::make($request->password) // Hashing password sebelum disimpan
                ]);

                // Jika update berhasil
                if ($update) {
                    return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui.');
                } else {
                    return redirect()->back()->with('error', 'Gagal memperbarui data pengguna.');
                }
            } else {
                return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
            }
        } else {
            return redirect()->back()->with('error', 'Nama pengguna (username) dan kata sandi (password) harus diisi.');
        }
    }


}
