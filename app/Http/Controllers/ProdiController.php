<?php

namespace App\Http\Controllers;
use App\Models\Prodi; // import model Mahasiswa
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function createProdi(Request $request){
        $id = $request -> id;
        $nama = $request -> nama;

        $prodi = Prodi::create([
            'id' => $id,
            'nama' => $nama
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'new prodi created',
            'data' => [
            'prodi' => $prodi,
            ]
        ],200);
    }

    public function getAllProdi()
    {
        $prodi = Prodi::all();

        return response()->json([
            'status' => 'Success',
            'message' => 'all prodi grabbed',
            'prodi' => $prodi
        ],200);
    }

    public function getProdiById(Request $request)
    {
        $prodi = Prodi::find($request->id);

        return response()->json([
            'status' => 'Success',
            'message' => 'prodi grabbed',
            'data' => [
                'prodi' => [
                    'id' => $prodi->id,
                    'nama' => $prodi->nama,
                    'mahasiswa' => $prodi->mahasiswas,
                ]
                
            ]
        ],200);
    }
}
