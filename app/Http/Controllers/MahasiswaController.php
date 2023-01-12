<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa; // import model Mahasiswa
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MahasiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
      //
    }

    public function getAllMahasiswa()
    {
        $mahasiswa = Mahasiswa::with('prodi')->get();

        return response()->json([
            'status' => 'Success',
            'message' => 'all mahasiswa grabbed',
            'mahasiswa' => $mahasiswa
        ],200);
    }

    public function getMahasiswaById(Request $request)
    {
        $mahasiswa = Mahasiswa::with('matakuliah', 'prodi')->find($request->nim);

        return response()->json([
            'status' => 'Success',
            'message' => 'mahasiswa grabbed',
            'mahasiswa' => $mahasiswa
        ],200);
    }

    public function addMatkulMhs(Request $request){
        
        $user = $request->user;

        $user->matakuliah()->attach($request->mkId);
            return response()->json([
                'success' => true,
                'message' => 'Matkul added to mahasiswa',
            ]);
    }

    public function delMatkulMhs(Request $request)
    {
        $user = $request->user;
        $user->matakuliah()->detach($request->mkId);
        return response()->json([
            'success' => true,
            'message' => 'matkul Deleted from mahasiswa',
        ]);
    }

    public function getUser(Request $request)
  {
    $user = $request->user;
    // $mahasiswa = Mahasiswa::where('nim', $user->nim)->first();
    $mahasiswa = Mahasiswa::with('matakuliah', 'prodi')->find($user->nim);
    if (!$mahasiswa) {
      return response()->json([
        'success' => false,
        'message' => 'mahasiswa tidak ditemukan',
      ], 404);
    }

    return response()->json([
      'success' => true,
      'message' => 'berhasil mendapatkan mahasiswa',
      'mahasiswa' => $mahasiswa
    ]);
  }
}
