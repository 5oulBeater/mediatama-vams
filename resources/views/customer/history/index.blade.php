@extends('layouts.app')

@section('title', 'History Request')

@section('content')
<h2 class="text-2xl font-bold mb-4">Riwayat Permintaan Video</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Video</th>
            <th>Status</th>
            <th>Requested At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($history as $h)
            <tr>
                <td>{{ $h->video->title }}</td>
                <td class="text-capitalize">{{ $h->status }}</td>
                <td>{{ $h->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
