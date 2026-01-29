@extends('layouts.app')

@section('header')
<h2 class="font-bold text-2xl text-indigo-700 drop-shadow-sm">
    Nova grupa
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

        <!-- Create group card -->
        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-8">

            <h3 class="text-2xl font-bold mb-6 text-indigo-700">
                Kreiraj novu grupu
            </h3>

            <form method="POST" action="{{ route('groups.store') }}" class="space-y-6">
                @csrf

                <!-- Group name -->
                <div>
                    <label class="block text-indigo-700 font-medium mb-1">Naziv grupe</label>
                    <input type="text" name="name"
                           class="w-full rounded-xl px-4 py-2 bg-white/70 border border-white/40 focus:ring-indigo-300 focus:border-indigo-400 transition"
                           placeholder="Unesi naziv grupe" required>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-indigo-700 font-medium mb-1">Opis</label>
                    <textarea name="description"
                              class="w-full rounded-xl px-4 py-2 bg-white/70 border border-white/40 focus:ring-indigo-300 focus:border-indigo-400 transition"
                              placeholder="Opis grupe"></textarea>
                </div>

                <!-- Members select -->
                <div>
                    <label class="block text-indigo-700 font-medium mb-2">Dodaj članove u grupu</label>

                    <select name="users[]" multiple
                            class="w-full rounded-xl px-4 py-2 h-48 bg-white/70 border border-white/40 focus:ring-indigo-300 focus:border-indigo-400 transition">

                        @foreach($users as $user)
                            @if($user->id !== auth()->id())
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endif
                        @endforeach

                    </select>

                    <p class="text-sm text-gray-600 mt-1">
                        Drži CTRL (Windows) ili CMD (Mac) za odabir više članova.
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">

                    <button type="submit"
                            class="px-6 py-2 rounded-xl bg-emerald-300 text-emerald-900 font-semibold shadow hover:bg-emerald-200 hover:scale-105 transition">
                        Spremi grupu
                    </button>

                    <a href="{{ route('groups.index') }}"
                       class="px-6 py-2 rounded-xl bg-rose-200 text-rose-900 font-semibold shadow hover:bg-rose-100 hover:scale-105 transition">
                        Nazad
                    </a>

                </div>

            </form>
        </div>

    </div>
</div>
@endsection
