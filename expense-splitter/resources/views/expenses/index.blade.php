@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-8">

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <a href="{{ route('groups.index') }}"
               class="text-indigo-600 hover:text-indigo-800 hover:underline transition">
                ← Natrag na grupe
            </a>

            <h2 class="text-3xl font-extrabold text-indigo-700 mt-2 drop-shadow-sm">
                Troškovi – {{ $group->name }}
            </h2>
        </div>

        <a href="{{ route('groups.expenses.create', $group->id) }}"
           class="px-5 py-2 rounded-xl bg-emerald-300 text-emerald-900 font-semibold shadow hover:bg-emerald-200 hover:scale-105 transition">
            + Dodaj trošak
        </a>
    </div>

    <!-- Table -->
    <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-indigo-100 text-indigo-900">
                <tr>
                    <th class="p-3">Naziv</th>
                    <th class="p-3">Iznos</th>
                    <th class="p-3">Datum</th>
                    <th class="p-3">Platio</th>
                    <th class="p-3">Akcije</th>
                </tr>
            </thead>

            <tbody>
            @foreach($expenses as $expense)
                <tr class="border-t border-white/40 hover:bg-white/40 transition">
                    <td class="p-3 text-gray-700">{{ $expense->title }}</td>
                    <td class="p-3 font-semibold text-gray-800">{{ $expense->amount }} €</td>
                    <td class="p-3 text-gray-700">{{ $expense->date }}</td>
                    <td class="p-3 text-gray-700">{{ $expense->user->name }}</td>

                    <td class="p-3 space-x-2">

                        <a href="{{ route('groups.expenses.edit', [$group->id, $expense->id]) }}"
                           class="px-3 py-1 rounded-xl bg-yellow-200 text-yellow-900 font-semibold shadow hover:bg-yellow-100 hover:scale-105 transition text-sm">
                            Uredi
                        </a>

                        <form method="POST"
                              action="{{ route('groups.expenses.destroy', [$group->id, $expense->id]) }}"
                              class="inline"
                              onsubmit="return confirm('Obrisati trošak?')">
                            @csrf
                            @method('DELETE')

                            <button class="px-3 py-1 rounded-xl bg-rose-200 text-rose-900 font-semibold shadow hover:bg-rose-100 hover:scale-105 transition text-sm">
                                Obriši
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Balance button -->
    <div class="text-right">
        <a href="{{ route('groups.balances', $group->id) }}"
           class="px-5 py-2 rounded-xl bg-indigo-300 text-indigo-900 font-semibold shadow hover:bg-indigo-200 hover:scale-105 transition">
            Izračun dugova →
        </a>
    </div>

</div>
@endsection
