@extends('layouts.app')

@section('header')
<h2 class="font-bold text-2xl text-indigo-700 drop-shadow-sm">
    Moje grupe
</h2>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Naslov -->
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-extrabold text-indigo-700 drop-shadow-sm">
                Moje grupe
            </h2>
        </div>

        <!-- Ako nema grupa -->
        @if($groups->count() == 0)
            <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6 text-gray-700">
                Još nemaš nijednu grupu.
            </div>
        @endif

        <!-- Lista grupa -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            @foreach($groups as $group)
            <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6 hover:shadow-lg transition">

                <!-- Naziv -->
                <h3 class="text-2xl font-bold text-indigo-700 mb-1">
                    {{ $group->name }}
                </h3>

                <p class="text-sm text-gray-700 mb-4">
                    {{ $group->description ?? 'Bez opisa grupe.' }}
                </p>

                <!-- Info -->
                <div class="bg-white/50 border border-white/40 rounded-xl p-4 mb-5 text-sm space-y-2">

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
                <div class="grid grid-cols-2 gap-3 mb-4">

                    @can('manageMembers', $group)
                    <a href="{{ route('groups.members', $group->id) }}"
                       class="text-center bg-purple-100 text-purple-800 py-2 rounded-xl hover:bg-purple-200 transition">
                        Članovi
                    </a>
                    @endcan

                    <a href="{{ route('groups.expenses.index', $group->id) }}"
                       class="text-center bg-blue-100 text-blue-800 py-2 rounded-xl hover:bg-blue-200 transition">
                        Troškovi
                    </a>

                    <a href="{{ route('groups.balances', $group->id) }}"
                       class="text-center bg-indigo-100 text-indigo-800 py-2 rounded-xl hover:bg-indigo-200 transition">
                        Dugovi
                    </a>

                    @can('update', $group)
                    <a href="{{ route('groups.edit', $group->id) }}"
                       class="text-center bg-yellow-100 text-yellow-800 py-2 rounded-xl hover:bg-yellow-200 transition">
                        Uredi
                    </a>
                    @endcan

                </div>

                @can('delete', $group)
                <!-- Delete -->
                <form action="{{ route('groups.destroy', $group->id) }}" method="POST"
                      onsubmit="return confirm('Sigurno želiš obrisati grupu?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="w-full bg-red-100 text-red-700 py-2 rounded-xl hover:bg-red-200 transition">
                        Obriši grupu
                    </button>
                </form>
                @endcan

            </div>
            @endforeach

        </div>

        <!-- Nova grupa -->
        <div class="flex justify-center pt-4">
            <a href="{{ route('groups.create') }}"
               class="px-6 py-3 rounded-xl bg-emerald-300 text-emerald-900 font-semibold shadow-md hover:bg-emerald-200 hover:scale-105 transition">
                + Nova grupa
            </a>
        </div>

    </div>
</div>
@endsection
