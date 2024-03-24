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

    // public function login(Request $request)
    // {
    //     $input = $request->all();

    //     $this->validate($request, [
    //         'name' => 'required',
    //         'password' => 'required',
    //     ]);

    //     $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
    //     if (auth()->attempt(array($fieldType => $input['name'], 'password' => $input['password']))) {
    //         if (auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin') {
    //             # code...
    //             return response()->json([
    //                 'status'=>'200',
    //                 'message'=>'Login success! Welcome back',
    //                 'link'=>'/admin-dashboard'
    //             ]);
    //         }else {
    //             # code...
    //             return response()->json([
    //                 'status'=>'400',
    //                 'message'=>'Maaf hanya admin yang diperbolehkan masuk'
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             'status'=>'400',
    //             'message'=>'Maaf periksa kembali username anda'
    //         ]);
    //     }
    // }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '400',
                'message' => 'Maaf periksa kembali username dan password Anda',
                'errors' => $validator->errors()->all()
            ]);
        }

        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $fieldType => $request->name,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            if ($user->role == 'admin' || $user->role == 'super_admin') {
                return response()->json([
                    'status' => '200',
                    'message' => 'Login success! Welcome back',
                    'link' => '/admin-dashboard'
                ]);
            } else {
                // Handle user not authorized to access
                return response()->json([
                    'status' => '403',
                    'message' => 'Anda tidak diizinkan untuk mengakses halaman ini'
                ], 403);
            }
        } else {
            // Handle invalid credentials
            return response()->json([
                'status' => '403',
                'message' => 'Kombinasi username dan password tidak valid'
            ], 403);
        }
    }


}

