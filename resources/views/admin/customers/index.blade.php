@extends('layouts.admin')

@section('content')

<div class="container mx-auto px-4 mt-6">

    <h2 class="text-2xl font-bold mb-4">Daftar Customer</h2>

    @if (session('success'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-left border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($customers as $c)
                <tr>
                    <td class="px-4 py-2 border">{{ $c->id }}</td>
                    <td class="px-4 py-2 border">{{ $c->name }}</td>
                    <td class="px-4 py-2 border">{{ $c->email }}</td>
                    <td class="px-4 py-2 border">
                        <form action="{{ route('admin.customers.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Yakin hapus customer ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection
