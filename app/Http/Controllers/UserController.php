<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getUsers()
    {
        $mahasiswa = mahasiswa::all();

        return response()->json([
            'status' => 'Success',
            'message' => 'all users grabbed',
            'mahasiswa' => $mahasiswa,
        ], 200);
    }
}