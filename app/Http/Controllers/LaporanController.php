<?php

namespace App\Http\Controllers;

use App\Models\laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = Laporan::with('user')
                    ->where('user_id', auth()->id()) // Only show current user's reports
                    ->orderBy('tanggal_laporan', 'desc')
                    ->paginate(10); // Use paginate instead of get()
        
        return view('laporan.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laporan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'media' => 'required|mimes:jpeg,png,jpg,gif,mp4,avi,mov,wmv|max:20480',
            'deskripsi' => 'required|string|max:255',
        ]);

        // Set additional fields for the laporan
        $data['user_id'] = auth()->id(); // Set the authenticated user's ID
        $data['tanggal_laporan'] = now()->format('Y-m-d'); // Set current date as laporan date
        $data['status_laporan'] = 'proses'; // Default status for new reports
        // Handle file upload if media is present
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $extension = $file->getClientOriginalExtension();
            $allowedImage = ['jpeg', 'png', 'jpg', 'gif'];
            $allowedVideo = ['mp4', 'avi', 'mov', 'wmv'];

            if (in_array(strtolower($extension), $allowedImage)) {
                // Store image files
                $data['media'] = $file->store('laporan_media/images', 'public');
            } elseif (in_array(strtolower($extension), $allowedVideo)) {
                // Store video files
                $data['media'] = $file->store('laporan_media/videos', 'public');
            } else {
                // Optional: handle unsupported file types
                return back()->withErrors(['media' => 'File type not supported.']);
            }
        }

        // Create a new laporan record with the validated data
        laporan::create($data);

        // Redirect back to the laporan index with a success message
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(laporan $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, laporan $laporan)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'media' => 'nullable|mimes:jpeg,png,jpg,gif,mp4,avi,mov,wmv|max:20480',
            'tanggal_laporan' => 'required|date_format:Y-m-d',
            'deskripsi' => 'required|string|max:255',
            'status_laporan' => 'required|in:proses,selesai',
        ]);

        // Handle file upload if media is present
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $extension = $file->getClientOriginalExtension();
            $allowedImage = ['jpeg', 'png', 'jpg', 'gif'];
            $allowedVideo = ['mp4', 'avi', 'mov', 'wmv'];

            if (in_array(strtolower($extension), $allowedImage)) {
                // Store image files
                $data['media'] = $file->store('laporan_media/images', 'public');
            } elseif (in_array(strtolower($extension), $allowedVideo)) {
                // Store video files
                $data['media'] = $file->store('laporan_media/videos', 'public');
            } else {
                // Optional: handle unsupported file types
                return back()->withErrors(['media' => 'File type not supported.']);
            }
        }

        // Update the laporan record with the validated data
        $laporan->update($data);

        // Redirect back to the laporan index with a success message
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, laporan $laporan)
    {
        //check if user is authenticated
        $user = auth()->user();
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('laporan.index')->withErrors(['error' => 'Unauthorized action.']);
        }

        // Validate the incoming request data
        $data = $request->validate([
            'status_laporan' => 'required|in:proses,selesai',
        ]);

        // Update the status of the laporan record
        $laporan->update($data);

        // Redirect back to the laporan index with a success message
        return redirect()->route('laporan.index')->with('success', 'Status laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(laporan $laporan)
    {
        //also delete the media file if it exists
        if ($laporan->media) {
            $mediaPath = public_path('storage/' . $laporan->media);
            if (file_exists($mediaPath)) {
                unlink($mediaPath);
            }
        }

        // Delete the laporan record
        $laporan->delete();

        // Redirect back to the laporan index with a success message
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
