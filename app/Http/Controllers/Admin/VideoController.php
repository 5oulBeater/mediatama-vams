<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video' => 'required|mimes:mp4,mov,avi,flv|max:500000',
        ]);

        // Upload Thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        // Upload Video File
        $videoPath = $request->file('video')->store('videos', 'public');

        Video::create([
            'title' => $request->title,
            'thumbnail' => $thumbnailPath,
            'video_url' => $videoPath,
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil ditambahkan!');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi,flv|max:500000',
        ]);

        // Update thumbnail jika ada file baru
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $video->thumbnail = $thumbnailPath;
        }

        // Update video jika ada file baru
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
            $video->video_url = $videoPath;
        }

        $video->title = $request->title;
        $video->save();

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil diperbarui!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return back()->with('success', 'Video berhasil dihapus!');
    }
}
