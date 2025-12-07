<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow px-6 py-4 flex justify-between">
    <h1 class="font-bold text-xl">Admin Panel</h1>

    <div class="flex gap-3">
        <a href="{{ route('admin.videos.index') }}" class="text-blue-600 font-semibold">Videos</a>
        <a href="{{ route('admin.customers.index') }}" class="text-blue-600 font-semibold">Customers</a>
        <a href="{{ route('admin.requests.index') }}" class="text-blue-600 font-semibold">Requests</a>

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
