@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold mb-6">Dashboard Admin</h2>

    <!-- STATISTICS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold text-gray-600">Total Pending</h3>
            <p class="text-4xl font-bold text-yellow-600 mt-2">{{ $pending }}</p>
        </div>

        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold text-gray-600">Total Approved</h3>
            <p class="text-4xl font-bold text-green-600 mt-2">{{ $approved }}</p>
        </div>

        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold text-gray-600">Total Rejected</h3>
            <p class="text-4xl font-bold text-red-600 mt-2">{{ $rejected }}</p>
        </div>
    </div>

    <!-- CHART SECTION -->
    <div class="bg-white p-6 shadow rounded-lg">
        <h3 class="text-xl font-bold mb-4">Statistik Request Akses Video</h3>

        <canvas id="requestChart" height="130"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('requestChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                label: 'Jumlah Request',
                data: [{{ $pending }}, {{ $approved }}, {{ $rejected }}],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
