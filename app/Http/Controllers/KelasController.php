<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();
        return response()->json($kelas);
        // return csrf_token();
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
        $request->validate([
            'nama' => 'required|string',
        ]);

        $kelas = new Kelas;

        $kelas->nama = $request['nama'];
        $kelas->save();
        return response()->json([
            "message" => "Kelas berhasil di buat"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::find($id);
        $siswa = Siswa::where('kelas', $id)->get();

        if (!$kelas) {
            return response()->json(['message' => 'Kelas not found'], 404);
        }
        if ($siswa->isEmpty()) {
            $siswa = [
                "message" => "Siswa kosong",
            ];
        }

        return response()->json([
            "kelas" => $kelas,
            "siswa" => $siswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $request->validate([
            "nama" => "required|string",
        ]);
        $kelas = Kelas::find($id);

        if (!$kelas) {
            return response()->json([
                "message" => "Kelas tidak di temukan"
            ]);
        }

        $kelas->nama = $request['nama'];
        $kelas->save();
        return response()->json([
            "message" => "Kelas berhasil di update"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        if (!$kelas) {
            return response()->json([
                "message" => "Kelas tidak ditemukan"
            ]);
        }

        Kelas::destroy($id);
        return response()->json([
            "message" => "Kelas berhasil di hapus"
        ]);
    }
}
