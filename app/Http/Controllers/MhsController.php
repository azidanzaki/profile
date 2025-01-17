<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa_2255301097;

class MhsController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa_2255301097::latest()->paginate(5);
        return view('mhs.list', compact('mahasiswa'));
    }
}
