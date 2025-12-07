@extends('layouts.admin')

@section('content')

<div class="container mx-auto px-4 mt-6">

    <h2 class="text-2xl font-bold mb-4">Daftar Permintaan Akses Video</h2>

    @if (session('success'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($requests->isEmpty())
        <p class="text-gray-600 text-center">Belum ada permintaan akses video.</p>
    @else
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-left border border-gray-300">

            <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Customer</th>
                <th class="px-4 py-2 border">Video</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Requested</th>
                <th class="px-4 py-2 border">Expired Time</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($requests as $req)
            <tr>
                <td class="border px-4 py-2">{{ $req->id }}</td>
                <td class="border px-4 py-2">{{ $req->user->name }}</td>
                <td class="border px-4 py-2">{{ $req->video->title }}</td>
                <td class="border px-4 py-2">{{ $req->status }}</td>
                <td class="border px-4 py-2">{{ $req->created_at->format('d M Y H:i') }}</td>

                <td class="border px-4 py-2">
                    @if($req->end_time)
                        <span class="text-red-600 font-semibold">
                            {{ \Carbon\Carbon::parse($req->end_time)->format('d M Y H:i') }}
                        </span>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </td>

                <td class="border px-4 py-2">
                    @if ($req->status === 'pending')
                        <form action="{{ route('admin.requests.approve', $req->id) }}" method="POST" class="approve-form inline-flex gap-1">
                            @csrf
                            <select name="duration" class="duration-select bg-gray-200 p-1 rounded">
                                <option value="1">1 Jam</option>
                                <option value="6">6 Jam</option>
                                <option value="24">24 Jam</option>
                                <option value="manual">Manual</option>
                            </select>

                            <input type="datetime-local" name="manual_time"
                                   class="manual-input p-1 rounded border"
                                   style="display:none;">

                            <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded">Approve</button>
                        </form>

                        <form action="{{ route('admin.requests.reject', $req->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">Reject</button>
                        </form>

                    @else
                        <span class="bg-blue-400 text-white px-2 py-1 rounded">Approved</span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>
    @endif
</div>

{{-- JAVASCRIPT UNTUK SETIAP BARIS --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".duration-select").forEach(select => {
        select.addEventListener("change", function () {
            const row = this.closest("form");
            const manualInput = row.querySelector(".manual-input");

            manualInput.style.display = (this.value === "manual") ? "inline-block" : "none";
        });
    });
});
</script>

@endsection
