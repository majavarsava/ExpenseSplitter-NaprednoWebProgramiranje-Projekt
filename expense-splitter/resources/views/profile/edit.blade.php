@extends('layouts.app')

@section('header')
<h2 class="font-bold text-2xl text-indigo-700 drop-shadow-sm">
    Moj profil
</h2>
@endsection

@section('content')
<div class="py-10">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

    <!-- USER INFO -->
    <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6">
        <h2 class="text-3xl font-extrabold text-indigo-700">{{ $user->name }}</h2>
        <p class="text-gray-700">{{ $user->email }}</p>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="rounded-2xl p-4 text-center bg-indigo-100 border border-indigo-200 shadow-sm">
            <p class="text-sm text-indigo-700">Moje grupe</p>
            <p class="text-3xl font-bold text-indigo-900">{{ $stats['groups'] }}</p>
        </div>

        <div class="rounded-2xl p-4 text-center bg-emerald-100 border border-emerald-200 shadow-sm">
            <p class="text-sm text-emerald-700">Potrošeno</p>
            <p class="text-3xl font-bold text-emerald-900">{{ number_format($stats['spent'], 2) }} €</p>
        </div>

        <div class="rounded-2xl p-4 text-center bg-rose-100 border border-rose-200 shadow-sm">
            <p class="text-sm text-rose-700">Dugujem</p>
            <p class="text-3xl font-bold text-rose-900">{{ number_format($stats['owes'], 2) }} €</p>
        </div>

        <div class="rounded-2xl p-4 text-center bg-purple-100 border border-purple-200 shadow-sm">
            <p class="text-sm text-purple-700">Treba mi se vratiti</p>
            <p class="text-3xl font-bold text-purple-900">{{ number_format($stats['gets'], 2) }} €</p>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- FINANCIAL SUMMARY -->
        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6">
            <h3 class="text-xl font-semibold text-indigo-700 mb-4">Financijski sažetak</h3>
            <canvas id="financeChart" height="220"></canvas>
        </div>

        <!-- GROUP STATS -->
        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6">
            <h3 class="text-xl font-semibold text-indigo-700 mb-4">Potrošnja po grupama</h3>
            <canvas id="groupsChart" height="220"></canvas>
        </div>

    </div>

    <!-- SETTINGS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6">
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
            backgroundColor: ['#6ee7b7', '#fca5a5', '#c4b5fd']
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
                '#93c5fd', '#6ee7b7', '#fde68a',
                '#fca5a5', '#c4b5fd', '#f9a8d4'
            ]
        }]
    }
});
</script>
@endsection
