@extends('layouts.app')

@section('title', 'Edit Video')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Edit Video</h2>

    <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label class="block mb-1 font-semibold">Judul Video</label>
            <input type="text" name="title"
                   value="{{ old('title', $video->title) }}"
                   class="w-full border rounded p-2 focus:outline-none focus:ring focus:ring-blue-300">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block mb-1 font-semibold">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded p-2 focus:outline-none focus:ring focus:ring-blue-300">{{ old('description', $video->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Video File -->
        <div>
            <label class="block mb-1 font-semibold">Upload Video Baru (Optional)</label>
            <input type="file" name="file"
                   class="w-full border p-2 rounded bg-gray-50">

            <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti video.</p>

            <!-- Current Video Preview -->
            <video width="300" controls class="mt-3 rounded shadow">
                <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                Browser tidak mendukung pemutar video.
            </video>
        </div>

        <!-- Submit -->
        <div class="pt-3">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                Update Video
            </button>

            <a href="{{ route('admin.videos.index') }}"
               class="ml-3 text-gray-600 hover:underline">Kembali</a>
        </div>
    </form>
</div>
@endsection
