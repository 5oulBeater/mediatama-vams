@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Daftar Video</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach ($videos as $video)
        <div class="bg-white p-4 shadow rounded-lg">
            
            {{-- Thumbnail Video --}}
            <img src="{{ asset('storage/' . $video->thumbnail) }}" 
                 alt="{{ $video->title }}" 
                 class="w-full h-40 object-cover rounded">

            <h3 class="mt-3 font-semibold text-lg">{{ $video->title }}</h3>

            {{-- Jika sudah approved, tampil tombol watch --}}
            @if(in_array($video->id, $approvedVideos))
                <a href="{{ route('customer.videos.watch', $video->id) }}"
                   class="mt-3 block text-center bg-green-600 hover:bg-green-700 text-white py-2 rounded">
                    🎬 Watch Now
                </a>
            @else
                <form action="{{ route('customer.videos.request', $video->id) }}" method="POST">
                    @csrf
                    <button class="mt-3 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded"
                        type="submit">
                        🔒 Request Access
                    </button>
                </form>
            @endif

        </div>
        @endforeach

    </div>
</div>
@endsection
