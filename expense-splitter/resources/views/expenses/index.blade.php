@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('groups.index') }}" class="text-blue-500 hover:underline">
                ← Natrag na grupe
            </a>
            <h2 class="text-2xl font-bold mt-2">Troškovi – {{ $group->name }}</h2>
        </div>

        <a href="{{ route('groups.expenses.create', $group->id) }}"
           class="bg-green-500 text-black px-4 py-2 rounded hover:bg-green-600">
            + Dodaj trošak
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
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
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3">{{ $expense->title }}</td>
                    <td class="p-3 font-semibold">{{ $expense->amount }} €</td>
                    <td class="p-3">{{ $expense->date }}</td>
                    <td class="p-3">{{ $expense->user->name }}</td>
                    <td class="p-3 space-x-2">

                        <a href="{{ route('groups.expenses.edit', [$group->id, $expense->id]) }}"
                           class="bg-yellow-400 text-black px-3 py-1 rounded text-sm hover:bg-yellow-500">
                            Uredi
                        </a>

                        <form method="POST"
                              action="{{ route('groups.expenses.destroy', [$group->id, $expense->id]) }}"
                              class="inline"
                              onsubmit="return confirm('Obrisati trošak?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-black px-3 py-1 rounded text-sm hover:bg-red-600">
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
    <div class="mt-6 text-right">
        <a href="{{ route('groups.balances', $group->id) }}"
           class="bg-indigo-500 text-black px-4 py-2 rounded hover:bg-indigo-600">
            Izračun dugova →
        </a>
    </div>

</div>
@endsection
