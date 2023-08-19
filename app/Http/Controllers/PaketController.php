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
        return view('paket.index', compact('pakets', 'konsumens'));
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

        $selectedKonsumenId = $validatedData['konsumen'];
        $konsumen = Konsumen::findOrFail($selectedKonsumenId);
        $alamat = $konsumen->alamat;

        $validatedData['alamat'] = $alamat;

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
}
