@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

        <!-- Welcome -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Dobrodošao/la, {{ Auth::user()->name }} 👋
            </h2>
            <p class="text-gray-600">
                Ovdje možeš upravljati grupama, troškovima i dugovima.
            </p>
        </div>

        <!-- Sections -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Groups -->
            <a href="{{ route('groups.index') }}"
               class="block bg-blue-50 border border-blue-200 rounded-lg p-6 hover:bg-blue-100 transition">

                <h3 class="text-lg font-semibold text-blue-800 mb-2">
                    👥 Moje grupe
                </h3>

                <p class="text-gray-700 mb-4">
                    Kreiraj i upravljaj svojim grupama.
                </p>

                <span class="text-blue-600 font-medium">
                    Otvori grupe →
                </span>
            </a>

            <!-- Expenses -->
            <a href="{{ route('groups.index') }}"
               class="block bg-green-50 border border-green-200 rounded-lg p-6 hover:bg-green-100 transition">

                <h3 class="text-lg font-semibold text-green-800 mb-2">
                    💸 Troškovi
                </h3>

                <p class="text-gray-700 mb-4">
                    Dodaj i pregledaj troškove po grupama.
                </p>

                <span class="text-green-600 font-medium">
                    Dodaj trošak →
                </span>
            </a>

            <!-- Debts -->
            <a href="{{ route('groups.index') }}"
               class="block bg-purple-50 border border-purple-200 rounded-lg p-6 hover:bg-purple-100 transition">

                <h3 class="text-lg font-semibold text-purple-800 mb-2">
                    📊 Dugovi
                </h3>

                <p class="text-gray-700 mb-4">
                    Izračunaj tko kome duguje.
                </p>

                <span class="text-purple-600 font-medium">
                    Pregled dugova →
                </span>
            </a>

        </div>
    </div>
</div>
@endsection
