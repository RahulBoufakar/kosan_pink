<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts instead of full records
        $unpaidBillsCount = Tagihan::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->count();

        $unfinishedReportsCount = Laporan::where('user_id', Auth::id())
            ->where('status_laporan', 'proses')
            ->count();

        return view('dashboard', [
            'unpaidBillsCount' => $unpaidBillsCount,
            'unfinishedReportsCount' => $unfinishedReportsCount
        ]);
    }
}