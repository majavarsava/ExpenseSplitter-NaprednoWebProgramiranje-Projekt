@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 space-y-6">

    <!-- Back link -->
    <a href="{{ route('groups.expenses.index', $group->id) }}"
       class="text-indigo-600 hover:text-indigo-800 hover:underline transition">
        ← Natrag na troškove
    </a>

    <h2 class="text-3xl font-extrabold text-indigo-700 mt-2 drop-shadow-sm">
        Uredi trošak
    </h2>

    <!-- Card -->
    <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-8">

        <form method="POST"
              action="{{ route('groups.expenses.update', [$group->id, $expense->id]) }}"
              class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Naziv -->
            <div>
                <label class="block text-indigo-700 font-medium mb-1">Naziv</label>
                <input type="text" name="title" value="{{ $expense->title }}"
                       class="w-full rounded-xl px-4 py-2 bg-white/70 border border-white/40
                              focus:ring-indigo-300 focus:border-indigo-400 transition">
            </div>

            <!-- Iznos -->
            <div>
                <label class="block text-indigo-700 font-medium mb-1">Iznos (€)</label>
                <input type="number" step="0.01" name="amount" value="{{ $expense->amount }}"
                       class="w-full rounded-xl px-4 py-2 bg-white/70 border border-white/40
                              focus:ring-indigo-300 focus:border-indigo-400 transition">
            </div>

            <!-- Datum -->
            <div>
                <label class="block text-indigo-700 font-medium mb-1">Datum</label>
                <input type="date" name="date" value="{{ $expense->date }}"
                       class="w-full rounded-xl px-4 py-2 bg-white/70 border border-white/40
                              focus:ring-indigo-300 focus:border-indigo-400 transition">
            </div>

            <!-- Opis -->
            <div>
                <label class="block text-indigo-700 font-medium mb-1">Opis</label>
                <textarea name="description" rows="3"
                          class="w-full rounded-xl px-4 py-2 bg-white/70 border border-white/40
                                 focus:ring-indigo-300 focus:border-indigo-400 transition">{{ $expense->description }}</textarea>
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="px-6 py-2 rounded-xl bg-indigo-300 text-indigo-900 font-semibold shadow
                           hover:bg-indigo-200 hover:scale-105 transition">
                Spremi promjene
            </button>

        </form>

    </div>
</div>
@endsection
