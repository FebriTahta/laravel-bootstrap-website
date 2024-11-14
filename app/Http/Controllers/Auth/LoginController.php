<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'regex:/^[a-zA-Z0-9_]+$/'],
            'password' => ['required', 'string', 'min:8'], // Tambahkan minimal panjang password
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Anda tidak memiliki akses',
            ]);
        }

        // Siapkan kredensial
        $credentials = [
            'name' => $request->name,
            'password' => $request->password
        ];
        // Coba autentikasi user
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            
            // Batasi akses berdasarkan role
            if ($user->role == 'admin' || $user->role == 'super_admin') {
                return response()->json([
                    'status' => 200,
                    'message' => 'Login success! Welcome back',
                    'link' => '/admin-dashboard'
                ]);
            } else {
                return response()->json([
                    'status' => 403, // Ubah ke 403 Forbidden
                    'message' => 'Maaf, hanya admin yang diperbolehkan masuk'
                ]);
            }
        } else {
            return response()->json([
                'status' => 401, // Ubah ke 401 Unauthorized
                'message' => 'Maaf, kombinasi nama pengguna dan kata sandi tidak valid.'
            ]);
        }
    }


}

