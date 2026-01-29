@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Moj profil
</h2>
@endsection

@section('content')
<div class="py-10">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

    <!-- USER INFO -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
        <p class="text-gray-600">{{ $user->email }}</p>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-blue-50 p-4 rounded text-center">
            <p class="text-sm text-gray-600">Moje grupe</p>
            <p class="text-2xl font-bold">{{ $stats['groups'] }}</p>
        </div>

        <div class="bg-green-50 p-4 rounded text-center">
            <p class="text-sm text-gray-600">Potrošeno</p>
            <p class="text-2xl font-bold">{{ number_format($stats['spent'], 2) }} €</p>
        </div>

        <div class="bg-red-50 p-4 rounded text-center">
            <p class="text-sm text-gray-600">Dugujem</p>
            <p class="text-2xl font-bold">{{ number_format($stats['owes'], 2) }} €</p>
        </div>

        <div class="bg-purple-50 p-4 rounded text-center">
            <p class="text-sm text-gray-600">Treba mi se vratiti</p>
            <p class="text-2xl font-bold">{{ number_format($stats['gets'], 2) }} €</p>
        </div>
    </div>

    <!-- CHARTS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- FINANCIAL SUMMARY -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Financijski sažetak</h3>
            <canvas id="financeChart" height="220"></canvas>
        </div>

        <!-- GROUP STATS -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Potrošnja po grupama</h3>
            <canvas id="groupsChart" height="220"></canvas>
        </div>

    </div>

    <!-- SETTINGS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 shadow rounded">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white p-6 shadow rounded">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white p-6 shadow rounded">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
/* Financije */
new Chart(document.getElementById('financeChart'), {
    type: 'bar',
    data: {
        labels: ['Potrošeno', 'Dugujem', 'Treba mi se vratiti'],
        datasets: [{
            data: [
                {{ $stats['spent'] }},
                {{ $stats['owes'] }},
                {{ $stats['gets'] }}
            ],
            backgroundColor: ['#34d399', '#f87171', '#a78bfa']
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

/* Grupe */
new Chart(document.getElementById('groupsChart'), {
    type: 'pie',
    data: {
        labels: {!! json_encode(array_keys($groupStats)) !!},
        datasets: [{
            data: {!! json_encode(array_values($groupStats)) !!},
            backgroundColor: [
                '#60a5fa', '#34d399', '#fbbf24',
                '#f87171', '#a78bfa', '#fb7185'
            ]
        }]
    }
});
</script>
@endsection
