<?php

namespace App\Http\Controllers;

use App\Models\kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamar = kamar::all();
        return view('admin.kamar.index', compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_kamar' => 'required|string|max:255',
            'status' => 'required|in:tersedia,penuh, diperbaiki',
        ]);

        kamar::create($data);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(kamar $kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kamar $kamar)
    {
        return view('admin.kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kamar $kamar)
    {
        $data = $request->validate([
            'nomor_kamar' => 'required|string|max:255',
            'status' => 'required|in:tersedia,penuh, diperbaiki',
        ]);

        // Check if the room number already exists
        if (kamar::where('nomor_kamar', $data['nomor_kamar'])->where('id', '!=', $kamar->id)->exists()) {
            return redirect()->back()->withErrors(['nomor_kamar' => 'Nomor kamar sudah ada.'])->withInput();
        }
        
        // Update the kamar
        $kamar->update($data);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kamar $kamar)
    {
        // Check if the room is occupied
        if ($kamar->user()->count() > 0) {
            return redirect()->route('kamar.index')->withErrors(['error' => 'Kamar tidak dapat dihapus karena sedang digunakan.']);
        }

        // Delete the kamar
        $kamar->delete();

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
