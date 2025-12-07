@extends('layouts.app')
@section('title', 'Dashboard Customer')

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Welcome {{ auth()->user()->name }}</h3>
        <p>Silakan pilih video untuk ditonton.</p>
    </div>
</div>
@endsection
