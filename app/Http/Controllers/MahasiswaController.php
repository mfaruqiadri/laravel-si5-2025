<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    // ✅ Tampilkan semua data mahasiswa
    public function index()
    {
        // ambil semua data dari tabel 'mahasiswas'
        $mahasiswas = Mahasiswa::all();

        // kirim ke view 'index.blade.php'
        return view('index', compact('mahasiswas'));
    }

    // ✅ Simpan data mahasiswa baru via AJAX
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required|string',
        ]);

        $mhs = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
        ]);

        // balikan JSON agar bisa ditampilkan tanpa reload
        return response()->json($mhs);
    }
}
