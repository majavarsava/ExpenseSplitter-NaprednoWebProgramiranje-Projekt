@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">

    <a href="{{ route('groups.expenses.index', $group->id) }}" class="text-blue-500 hover:underline">
        ← Natrag na troškove
    </a>

    <h2 class="text-2xl font-bold mb-6 mt-2">Uredi trošak</h2>

    <div class="bg-white shadow rounded-lg p-6">

        <form method="POST" action="{{ route('groups.expenses.update', [$group->id, $expense->id]) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold">Naziv</label>
                <input type="text" name="title" value="{{ $expense->title }}"
                       class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold">Iznos (€)</label>
                <input type="number" step="0.01" name="amount" value="{{ $expense->amount }}"
                       class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold">Datum</label>
                <input type="date" name="date" value="{{ $expense->date }}"
                       class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold">Opis</label>
                <textarea name="description"
                          class="w-full border rounded p-2"
                          rows="3">{{ $expense->description }}</textarea>
            </div>

            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Spremi promjene
            </button>

        </form>

    </div>
</div>
@endsection
