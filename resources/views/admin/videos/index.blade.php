{{-- resources/views/admin/videos/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="p-6">

    {{-- Title + Create Button --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Video</h1>
        <a href="{{ route('admin.videos.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            + Tambah Video
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Thumbnail</th>
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Deskripsi</th>
                    <th class="px-6 py-3">Video</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($videos as $video)
                    <tr class="border-b hover:bg-gray-50">
                        {{-- Thumbnail --}}
                        <td class="px-6 py-4">
                            <img src="{{ asset('storage/' . $video->thumbnail) }}"
                                 class="w-20 h-14 object-cover rounded border"/>
                        </td>

                        {{-- Title --}}
                        <td class="px-6 py-4 font-medium">{{ $video->title }}</td>

                        {{-- Description --}}
                        <td class="px-6 py-4">{{ Str::limit($video->description, 50) }}</td>

                        {{-- Video file --}}
                        <td class="px-6 py-4">
                            <a href="{{ asset('storage/' . $video->video_url) }}"
                               class="text-blue-600 hover:underline"
                               target="_blank">
                                Lihat Video
                            </a>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-center flex gap-2 justify-center">

                            <a href="{{ route('admin.videos.edit', $video->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Edit
                            </a>

                            <form action="{{ route('admin.videos.destroy', $video->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus video ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">
                            Belum ada video yang ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
