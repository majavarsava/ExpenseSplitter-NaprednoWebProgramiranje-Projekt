@extends('layouts.app')

@section('header')
    <h2 class="font-bold text-2xl text-indigo-700 drop-shadow-sm">
        Članovi grupe: {{ $group->name }}
    </h2>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Back link -->
        <div>
            <a href="{{ route('groups.index') }}"
               class="text-indigo-600 hover:text-indigo-800 hover:underline flex items-center transition">
                ← Natrag na grupe
            </a>
        </div>

        <!-- Add member card -->
        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6">
            <h3 class="text-xl font-semibold mb-4 text-indigo-700">
                Dodaj novog člana
            </h3>

            <form method="POST" action="{{ route('groups.members.store', $group->id) }}"
                  class="flex flex-col md:flex-row gap-4">
                @csrf

                <select name="user_id"
                        class="w-full md:w-2/3 rounded-xl px-4 py-2 bg-white/70 border border-white/40 focus:ring-indigo-300 focus:border-indigo-400 transition">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="px-6 py-2 rounded-xl bg-emerald-300 text-emerald-900 font-semibold shadow hover:bg-emerald-200 hover:scale-105 transition">
                    + Dodaj člana
                </button>
            </form>
        </div>

        <!-- Members list card -->
        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-6">
            <h3 class="text-xl font-semibold mb-4 text-indigo-700">
                Postojeći članovi
            </h3>

            @if($group->users->count() == 0)
                <p class="text-gray-600">Još nema članova u ovoj grupi.</p>
            @else
                <ul class="divide-y divide-white/40">
                    @foreach($group->users as $user)
                        <li class="flex justify-between items-center py-3">

                            <div>
                                <p class="font-medium text-indigo-700">{{ $user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                            </div>

                            @if($user->id == $group->owner_id)
                                <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">
                                    Vlasnik grupe
                                </span>
                            @else
                            <form method="POST"
                                  action="{{ route('groups.members.destroy', [$group->id, $user->id]) }}"
                                  onsubmit="return confirm('Sigurno želiš ukloniti ovog člana?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-4 py-1 rounded-xl bg-rose-200 text-rose-900 font-semibold shadow hover:bg-rose-100 hover:scale-105 transition text-sm">
                                    Ukloni
                                </button>
                            </form>
                            @endif

                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
</div>
@endsection
