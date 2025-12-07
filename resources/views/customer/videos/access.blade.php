@extends('layouts.app')

@section('title', 'Watch Video')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    <a href="{{ route('customer.videos.index') }}" 
        class="inline-flex items-center mb-5 text-blue-600 hover:underline">
        ← Back to Videos
    </a>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            {{ $video->title }}
        </h2>

        {{-- Video Player --}}
        <video controls class="w-full rounded-xl shadow-md">
            <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
            Access Approved ✔ You are allowed to watch this video.
        </div>
    </div>
</div>
@endsection
