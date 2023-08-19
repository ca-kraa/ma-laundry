<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Konsumen;

class KonsumenController extends Controller
{
    public function index()
    {
        $konsumens = Konsumen::all();
        return view('konsumen.index', compact('konsumens'));
    }

    public function create()
    {
        return view('konsumen.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'username' => 'required',
            'pin' => 'required',
            'nomor_hp' => 'required',
            'alamat' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
            'status' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        $validatedData['status'] = $request->input('status', 'Aktif');

        Konsumen::create($validatedData);

        return redirect()->route('konsumen.index')->with('success', 'Konsumen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $konsumen = Konsumen::findOrFail($id);
        return view('konsumen.edit', compact('konsumen'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'username' => 'required',
            'pin' => 'required',
            'nomor_hp' => 'required',
            'alamat' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'status' => 'nullable',
        ]);

        $konsumen = Konsumen::findOrFail($id);

        if ($request->hasFile('photo')) {
            if ($konsumen->photo) {
                Storage::disk('public')->delete($konsumen->photo);
            }

            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        $konsumen->update($validatedData);

        return redirect()->route('konsumen.index')->with('success', 'Konsumen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $konsumen = Konsumen::findOrFail($id);

        if ($konsumen->photo) {
            Storage::disk('public')->delete($konsumen->photo);
        }

        $konsumen->delete();

        return redirect()->route('konsumen.index')->with('success', 'Konsumen berhasil dihapus.');
    }
    public function changeStatus(Request $request, $id)
    {
        $konsumen = Konsumen::findOrFail($id);

        $newStatus = $konsumen->status === 'Aktif' ? 'Nonaktif' : 'Aktif';
        $konsumen->status = $newStatus;
        $konsumen->save();

        return redirect()->back()->with('success', 'Status konsumen berhasil diubah.');
    }

    public function getAlamat($id)
    {
        $konsumen = Konsumen::findOrFail($id);
        return response()->json(['alamat' => $konsumen->alamat]);
    }
}
