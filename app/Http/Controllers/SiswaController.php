<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Matakuliah;
use App\Models\Nilai;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::all();
        return response()->json($siswa);
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
            "nim" => "required|string",
            "nama" => "required|string",
            "kelas" => "required|string"
        ]);

        $siswa = new Siswa([
            "nim" => $request['nim'],
            "nama" => $request['nama'],
            "kelas" => $request['kelas']
        ]);
        $siswa->save();
        return response()->json([
            "message" => "Siswa berhasil di tambahkan"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        $siswa = Siswa::where("nim", $nim)->first();
        $matakuliah = Matakuliah::all();
        $nilai = Nilai::where("nim", $nim)->get();

        $nilai_matakuliah = [];
        $nilai_akhir = [];
        foreach ($matakuliah as $matkul) {
            $tempnilai = []; // Inisialisasi $tempnilai pada setiap iterasi mata kuliah
            $nilaiakhir = [];
            foreach ($nilai as $n) {
                if ($n->nim === $nim && $n->id_matkul == $matkul['_id']) {
                    $tempnilai = [
                        "nama_matkul" => $matkul['nama_matkul'],
                        'latihan_soal' => $n->latihan_soal,
                        'ulangan_harian' => $n->ulangan_harian,
                        'uts' => $n->uts,
                        'uas' => $n->uas,
                    ];
                    $nilaiakhir = [
                        "nama_matkul" => $tempnilai['nama_matkul'],
                        "nilai_akhir" => ((array_sum($tempnilai['latihan_soal']) / count($tempnilai['latihan_soal'])) * 15 / 100) + ((array_sum($tempnilai['ulangan_harian']) / count($tempnilai['ulangan_harian']))  * 20 / 100) + (25 / 100 * $tempnilai['uts']) + (40 / 100 * $tempnilai['uas'])
                    ];
                    break;
                }
            }
            if ($tempnilai !== []) {
                array_push($nilai_matakuliah, $tempnilai);
                array_push($nilai_akhir, $nilaiakhir);
            }
        }

        if (!$siswa) {
            return response()->json([
                "message" => "Siswa tidak ditemukan"
            ]);
        }

        return response()->json([
            "siswa" => $siswa,
            "nilai_akhir" => $nilai_akhir,
            "nilai_matkul" => $nilai_matakuliah
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
