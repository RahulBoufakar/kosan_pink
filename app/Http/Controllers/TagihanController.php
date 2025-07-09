<?php

// app/Http/Controllers/TagihanController.php
namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::with(['payment', 'user'])
            ->where('user_id', Auth::id())
            ->orderBy('tanggal_tagihan', 'desc')
            ->paginate(10);
        
        return view('tagihan.index', compact('tagihans'));
    }
}