@extends('layouts.app')

@section('title', $video->title)

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $video->title }}</h2>

    <div class="relative">
        <video id="videoPlayer" width="100%" height="auto" controls>
            <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
            Browser Anda tidak mendukung video tag.
        </video>

        <!-- Overlay muncul jika expired -->
        <div id="expiredOverlay" class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center text-white text-center p-6"
             style="display: none;">
            <div>
                <h3 class="text-2xl font-bold mb-2">Akses Habis</h3>
                <p>Akses Anda untuk video ini telah berakhir.</p>
                <a href="{{ route('customer.videos.index') }}" class="inline-block mt-4 px-4 py-2 bg-gray-600 rounded">Kembali</a>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <span id="countdown" class="font-semibold text-lg">⏳ Loading...</span>
    </div>

    <a href="{{ route('customer.videos.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded">
        Kembali
    </a>
</div>

<script>
(function () {
    const endTimeIso = @json($endTimeIso);
    const video = document.getElementById('videoPlayer');
    const countdownEl = document.getElementById('countdown');
    const overlay = document.getElementById('expiredOverlay');

    if (!endTimeIso) {
        countdownEl.textContent = 'Akses tanpa batas';
        return;
    }

    const endTime = new Date(endTimeIso);

    function updateCountdown() {
        const now = new Date();
        const distance = endTime - now;

        if (distance <= 0) {
            countdownEl.textContent = '⏰ Waktu habis';
            video.pause();
            video.controls = false;
            overlay.style.display = 'flex';
            clearInterval(timer);
            return;
        }

        const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((distance / (1000 * 60)) % 60);
        const seconds = Math.floor((distance / 1000) % 60);

        const pad = n => String(n).padStart(2, '0');

        countdownEl.textContent = `⏳ Sisa waktu: ${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
    }

    const timer = setInterval(updateCountdown, 1000);
    updateCountdown();

    video.addEventListener('timeupdate', function () {
        if (new Date() >= endTime) {
            video.pause();
            video.controls = false;
            overlay.style.display = 'flex';
        }
    });
})();
</script>

@endsection
