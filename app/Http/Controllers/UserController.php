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
        // Validasi input yang diperlukan (opsional)
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Periksa apakah username dan password tidak null
        if ($request->username !== null && $request->password !== null) {
            // Update data pengguna
            $update = User::where('id', $request->id)
                ->update([
                    'name' => $request->username,
                    'pass_vis' => $request->password,
                    'password' => Hash::make($request->password)
                ]);
            // return $update;

            return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Nama pengguna (username) dan kata sandi (password) harus diisi.');
        }
    }

}
