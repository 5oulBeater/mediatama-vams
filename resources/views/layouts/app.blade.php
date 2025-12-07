<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MEDIATAMA</a>

        <div class="">
            <ul class="navbar-nav ms-auto">
                <li>
                   <a href="{{ route('customer.history.index') }}">History</a>
                </li>
                <li class="nav-item">
                    <span class="nav-link text-white">Hello, {{ auth()->user()->name }}</span>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm ms-2">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

{{-- Popup Notification --}}
@if (session('success') || session('error'))
    <div id="popupMessage"
        class="fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg text-white
            {{ session('success') ? 'bg-green-600' : 'bg-red-600' }}">
        <strong>{{ session('success') ?? session('error') }}</strong>
    </div>

    <script>
        setTimeout(() => {
            const popup = document.getElementById('popupMessage');
            if (popup) popup.style.display = 'none';
        }, 3000);
    </script>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
