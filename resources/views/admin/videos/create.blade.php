@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">

        <h2 class="text-2xl font-bold mb-4">Tambah Video Baru</h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="p-3 bg-green-100 text-green-700 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="font-semibold">Judul Video</label>
                <input type="text" name="title" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="font-semibold">Deskripsi</label>
                <textarea name="description" class="w-full border rounded p-2"></textarea>
            </div>

            <div>
                <label class="font-semibold">Thumbnail (JPG/PNG)</label>
                <input type="file" name="thumbnail" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="font-semibold">Upload Video (MP4/MOV/WEBM)</label>
                <input type="file" name="video" class="w-full border rounded p-2" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan Video
            </button>
        </form>


    </div>
</div>
@endsection
