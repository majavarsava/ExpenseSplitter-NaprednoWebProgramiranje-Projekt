@extends('layouts.app')

@section('header')
<h2 class="font-bold text-xl text-gray-800 leading-tight">
    Moje grupe
</h2>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Moje grupe</h2>

            <a href="{{ route('groups.create') }}"
               class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                + Nova grupa
            </a>
        </div>

        @if($groups->count() == 0)
            <div class="bg-white p-6 rounded-lg shadow text-gray-600">
                Još nemaš nijednu grupu.
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @foreach($groups as $group)
            <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition border">

                <!-- Naziv -->
                <h3 class="text-xl font-bold text-gray-800 mb-1">
                    {{ $group->name }}
                </h3>

                <p class="text-sm text-gray-600 mb-3">
                    {{ $group->description ?? 'Bez opisa grupe.' }}
                </p>

                <!-- Info -->
                <div class="bg-gray-50 rounded-lg p-4 mb-4 text-sm space-y-2">

                    <p>
                        👥 <span class="font-semibold">Članova:</span>
                        {{ $group->users->count() }}
                    </p>

                    <p>
                        💰 <span class="font-semibold">Ukupni troškovi:</span>
                        {{ number_format($group->expenses->sum('amount'), 2) }} €
                    </p>

                    <p>
                        🧑‍🤝‍🧑 <span class="font-semibold">Članovi:</span>
                        @foreach($group->users->take(3) as $user)
                            {{ $user->name }}@if(!$loop->last), @endif
                        @endforeach
                        @if($group->users->count() > 3)
                            ...
                        @endif
                    </p>

                </div>

                <!-- Akcije -->
                <div class="grid grid-cols-2 gap-3 mb-3">

                    <a href="{{ route('groups.members', $group->id) }}"
                       class="text-center bg-purple-100 text-purple-800 py-2 rounded hover:bg-purple-200">
                        Članovi
                    </a>

                    <a href="{{ route('groups.expenses.index', $group->id) }}"
                       class="text-center bg-blue-100 text-blue-800 py-2 rounded hover:bg-blue-200">
                        Troškovi
                    </a>

                    <a href="{{ route('groups.balances', $group->id) }}"
                       class="text-center bg-indigo-100 text-indigo-800 py-2 rounded hover:bg-indigo-200">
                        Dugovi
                    </a>

                    <a href="{{ route('groups.edit', $group->id) }}"
                       class="text-center bg-yellow-100 text-yellow-800 py-2 rounded hover:bg-yellow-200">
                        Uredi
                    </a>

                </div>

                <!-- Delete -->
                <form action="{{ route('groups.destroy', $group->id) }}" method="POST"
                      onsubmit="return confirm('Sigurno želiš obrisati grupu?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="w-full bg-red-100 text-red-700 py-2 rounded hover:bg-red-200">
                        Obriši grupu
                    </button>
                </form>

            </div>
            @endforeach

        </div>

    </div>
</div>
@endsection
