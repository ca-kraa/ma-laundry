<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Konsumen;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        $konsumens = Konsumen::all();
        $filteredPakets = $pakets;

        return view('paket.index', compact('pakets', 'konsumens', 'filteredPakets'));
    }

    public function create()
    {
        return view('paket.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'konsumen' => 'required',
            'alamat' => 'required',
            'paket_kuota' => 'required',
            'berat' => 'required',
            'harga' => 'required',
            'pembayaran' => 'required',
            'total' => 'required',
            'cabang' => 'required',
            'status' => 'nullable',
        ]);

        $selectedKonsumenNama = $validatedData['konsumen'];
        $namaParts = explode(' ', $selectedKonsumenNama); // Pisahkan nama depan dan belakang
        $namaDepan = $namaParts[0];
        $namaBelakang = $namaParts[1];

        $konsumen = Konsumen::where('nama_depan', $namaDepan)
            ->where('nama_belakang', $namaBelakang)
            ->first();

        if ($konsumen) {
            $alamat = $konsumen->alamat;
            $validatedData['alamat'] = $alamat;
            Paket::create($validatedData);
            return redirect()->route('paket.index')->with('success', 'Data paket berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Konsumen tidak ditemukan.');
        }

        Paket::create($validatedData);

        return redirect()->route('paket.index')->with('success', 'Data paket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        return view('paket.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'konsumen' => 'nullable',
            'alamat' => 'nullable',
            'paket_kuota' => 'nullable',
            'berat' => 'nullable',
            'harga' => 'nullable',
            'pembayaran' => 'nullable',
            'total' => 'nullable',
            'cabang' => 'nullable',
            'status' => 'nullable',
        ]);

        $paket = Paket::findOrFail($id);
        $paket->update($validatedData);

        return redirect()->route('paket.index')->with('success', 'Data paket berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Data paket berhasil dihapus.');
    }
    public function changeStatus($id)
    {
        $paket = Paket::findOrFail($id);

        $paket->status = $paket->status == 'Aktif' ? 'Tidak Aktif' : 'Aktif';
        $paket->save();

        return redirect()->route('paket.index')->with('success', 'Status berhasil diubah.');
    }
    public function filter(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $filteredPakets = Paket::whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
            ->get();

        $konsumens = Konsumen::all();
        $pakets = Paket::all();

        return view('paket.index', compact('filteredPakets', 'konsumens', 'pakets'));
    }
}
