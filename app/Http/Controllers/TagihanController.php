<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     */
    public function index()
    {
        // ketika role admin, tampilkan semua tagihan
        if(auth()->user()->role == 'admin'){
            $tagihans = Tagihan::all();
            return view('admin.tagihan.index', compact('tagihans'));
        }
        
        //ketika role user, tampilkan tagihan milik user tersebut
        $tagihans = Tagihan::where('user_id', auth()->user()->id)->get();
        return view('tagihan.index', compact('tagihans'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tagihan $tagihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan $tagihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tagihan $tagihan)
    {
        //
    }
}
