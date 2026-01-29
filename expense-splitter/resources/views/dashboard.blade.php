@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Dashboard
</h2>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Welcome -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Dobrodošao/la, {{ Auth::user()->name }} 👋
            </h2>
            <p class="text-gray-600">
                Ovdje imaš brzi pregled i najčešće akcije za Expense Splitter.
            </p>
        </div>

        <!-- Quick actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Nova grupa -->
            <a href="{{ route('groups.create') }}"
               class="block bg-blue-50 border border-blue-200 rounded-lg p-6 hover:bg-blue-100 transition">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">
                    ➕ Nova grupa
                </h3>
                <p class="text-gray-700">
                    Kreiraj novu grupu i dodaj članove.
                </p>
            </a>

            <!-- Dodaj trošak -->
            <a href="{{ route('groups.index') }}"
               class="block bg-green-50 border border-green-200 rounded-lg p-6 hover:bg-green-100 transition">
                <h3 class="text-lg font-semibold text-green-800 mb-2">
                    💸 Dodaj trošak
                </h3>
                <p class="text-gray-700">
                    Odaberi grupu i unesi novi trošak.
                </p>
            </a>

            <!-- Pregled dugova -->
            <a href="{{ route('groups.index') }}"
               class="block bg-purple-50 border border-purple-200 rounded-lg p-6 hover:bg-purple-100 transition">
                <h3 class="text-lg font-semibold text-purple-800 mb-2">
                    📊 Pregled dugova
                </h3>
                <p class="text-gray-700">
                    Pogledaj tko kome duguje po grupama.
                </p>
            </a>

        </div>

        <!-- Info section -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-3">Kako koristiti aplikaciju?</h3>
            <ul class="list-disc ml-6 text-gray-700 space-y-1">
                <li>Kreiraj grupu i dodaj članove</li>
                <li>Unosi troškove po grupama</li>
                <li>Automatski izračunaj dugove</li>
                <li>Evidentiraj uplate i zatvori dugove</li>
            </ul>
        </div>

    </div>
</div>
@endsection
