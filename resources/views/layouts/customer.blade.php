<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow px-6 py-4 flex justify-between">
    <h1 class="font-bold text-xl">Customer Dashboard</h1>
    <li>
        <a href="{{ route('customer.history.index') }}">History</a>
    </li>

    <div class="flex gap-3">
        <a href="{{ route('customer.videos.index') }}" class="text-blue-600 font-semibold">Video List</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-red-600 font-semibold">Logout</button>
        </form>
    </div>
</nav>

<div class="p-6">
    @yield('content')
</div>

</body>
</html>
