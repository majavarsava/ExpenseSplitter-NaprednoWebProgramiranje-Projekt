@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-2xl text-indigo-700 leading-tight drop-shadow-sm">
    Dashboard
</h2>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Welcome -->
        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6">
            <h2 class="text-2xl font-bold text-indigo-700 mb-2">
                Dobrodošao/la, {{ Auth::user()->name }} 👋
            </h2>
            <p class="text-gray-700">
                Ovdje imaš brzi pregled i najčešće akcije za Expense Splitter.
            </p>
        </div>

        <!-- Quick actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Nova grupa -->
            <a href="{{ route('groups.create') }}"
               class="block rounded-2xl p-6 bg-indigo-100 border border-indigo-200 shadow-sm hover:bg-indigo-50 hover:shadow-md transition-all">
                <h3 class="text-lg font-semibold text-indigo-800 mb-2">
                    ➕ Nova grupa
                </h3>
                <p class="text-gray-700">
                    Kreiraj novu grupu i dodaj članove.
                </p>
            </a>

            <!-- Dodaj trošak -->
            <a href="{{ route('groups.index') }}"
               class="block rounded-2xl p-6 bg-emerald-100 border border-emerald-200 shadow-sm hover:bg-emerald-50 hover:shadow-md transition-all">
                <h3 class="text-lg font-semibold text-emerald-800 mb-2">
                    💸 Dodaj trošak
                </h3>
                <p class="text-gray-700">
                    Odaberi grupu i unesi novi trošak.
                </p>
            </a>

            <!-- Pregled dugova -->
            <a href="{{ route('groups.index') }}"
               class="block rounded-2xl p-6 bg-rose-100 border border-rose-200 shadow-sm hover:bg-rose-50 hover:shadow-md transition-all">
                <h3 class="text-lg font-semibold text-rose-800 mb-2">
                    📊 Pregled dugova
                </h3>
                <p class="text-gray-700">
                    Pogledaj tko kome duguje po grupama.
                </p>
            </a>

        </div>

        <!-- Info section -->
        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6">
            <h3 class="text-xl font-semibold text-indigo-700 mb-3">Kako koristiti aplikaciju?</h3>
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
