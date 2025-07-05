<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Concert;

class ConcertController extends Controller
{
    public function index()
    {
        $concerts = Concert::paginate(10);
        return view('admin.concerts.index', compact('concerts'));
    }

    public function create()
    {
        return view('admin.concerts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_band' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'harga' => 'required|numeric',
            'stok_tiket' => 'required|integer|min:0',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_band', 'tanggal', 'lokasi', 'harga', 'stok_tiket']);
        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }
        Concert::create($data);
        return redirect()->route('admin.concerts.index')->with('success', 'Event berhasil ditambahkan');
    }

    public function edit($id)
    {
        $concert = Concert::findOrFail($id);
        return view('admin.concerts.edit', compact('concert'));
    }

    public function update(Request $request, $id)
    {
        $concert = Concert::findOrFail($id);
        $request->validate([
            'nama_band' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'harga' => 'required|numeric',
            'stok_tiket' => 'required|integer|min:0',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $data = $request->only(['nama_band', 'tanggal', 'lokasi', 'harga', 'stok_tiket']);
        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }
        $concert->update($data);
        return redirect()->route('admin.concerts.index')->with('success', 'Event berhasil diupdate');
    }

    public function destroy($id)
    {
        $concert = Concert::findOrFail($id);
        $concert->delete();
        return redirect()->route('admin.concerts.index')->with('success', 'Event berhasil dihapus');
    }
}
