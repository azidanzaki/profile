<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa_2255301097;
use App\Http\Resources\MahasiswaResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa= Mahasiswa_2255301097::latest()->paginate(5);
        return new MahasiswaResource(true, 'List Data Mahasiswa', $mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_mahasiswa_2255301097' => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'no_hp'         => 'required',
            'email'         => 'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $mahasiswa=Mahasiswa_2255301097::create([
            'nama_mahasiswa_2255301097' => $request -> nama_mahasiswa_2255301097,
            'tempat_lahir'  => $request-> tempat_lahir,
            'tanggal_lahir' => $request-> tanggal_lahir,
            'no_hp'         => $request-> no_hp,
            'email'         => $request-> email,
        ]);
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Ditambahkan', $mahasiswa);
        return view('mhs.list', compact('mahasiswa'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa_2255301097 $mahasiswa)
    {
        return new MahasiswaResource(true, "Data Mahasiswa Ditemukan! ", $mahasiswa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_mahasiswa_2255301097' => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'no_hp'         => 'required',
            'email'         => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Mendapatkan instance Mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa_2255301097::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404);
        }

        $mahasiswa->update([
            'nama_mahasiswa_2255301097' => $request -> nama_mahasiswa_2255301097,
            'tempat_lahir'  => $request-> tempat_lahir,
            'tanggal_lahir' => $request-> tanggal_lahir,
            'no_hp'         => $request-> no_hp,
            'email'         => $request-> email,
        ]);

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diubah!', $mahasiswa);
    }
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa_2255301097::findOrFail($id);
        $mahasiswa->delete();
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Dihapus!', null);
    }

}
