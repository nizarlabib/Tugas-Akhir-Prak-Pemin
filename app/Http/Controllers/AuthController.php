<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) //
  {
    //

    $this->request = $request;
  }

  //
  protected function jwt(Mahasiswa $mahasiswa)
  {
    $payload = [
      'iss' => 'lumen-jwt', //issuer of the token
      'sub' => $mahasiswa->nim, //subject of the token
      'iat' => time(), //time when JWT was issued.
      'exp' => time() + 60 * 60 //time when JWT will expire
    ];

    return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
  }

  public function login(Request $request)
  {
    $nim = $request->nim;
    $password = $request->password;

    $user = Mahasiswa::where('nim', $nim)->first();

    if (!$user) {
      return response()->json([
        'status' => 'Error',
        'message' => 'user not exist',
      ], 404);
    }

    if (!Hash::check($password, $user->password)) {
      return response()->json([
        'status' => 'Error',
        'message' => 'wrong password',
      ], 400);
    }

    $user->token = $this->jwt($user);

    $user->save();

    return response()->json([
      'status' => 'Success',
      'message' => 'successfully login',
      'token' => $user->token
    ], 200);
  }
    //
    public function register(Request $request)
    {
        $nim = $request->nim;
        $nama = $request->nama;
        $angkatan = $request->angkatan;
        $password = Hash::make($request->password);
        $prodiId = $request->prodiId;

        $user = Mahasiswa::create([
            'nim' => $nim,
            'nama' => $nama,
            'angkatan' => $angkatan,
            'password' => $password,
            'prodiId' => $prodiId
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'new user created',
            'user' => $user
        ],200);
    }
   
   
}