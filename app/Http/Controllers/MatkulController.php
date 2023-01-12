<?php

namespace App\Http\Controllers;
use App\Models\Matakuliah; // import model Mahasiswa
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MatkulController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function createMatkul(Request $request){
        $id = $request -> id;
        $nama = $request -> nama;

        $matkul = Matakuliah::create([
            'id' => $id,
            'nama' => $nama
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'new matkul created',
            'data' => [
            'matkul' => $matkul,
            ]
        ],200);
    }

    public function getAllMatkul()
    {
        $matkul = Matakuliah::all();

        return response()->json([
            'status' => 'Success',
            'message' => 'all matkul grabbed',
            'matakuliah' => $matkul
        ],200);
    }

    public function getMatkulById(Request $request)
    {
        $matkul = Matakuliah::find($request->id);

        return response()->json([
            'status' => 'Success',
            'message' => 'all matkul grabbed',
            'data' => [
                'matkul' => $matkul,
            ]
        ],200);
    }
}
