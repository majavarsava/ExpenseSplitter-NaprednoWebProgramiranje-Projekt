@extends('layouts.app')

@section('header')
<h2 class="font-bold text-2xl text-indigo-700 drop-shadow-sm">
    Uredi grupu
</h2>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

        <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-8">

            <h2 class="text-2xl font-bold mb-6 text-indigo-700">
                Uredi grupu: {{ $group->name }}
            </h2>

            <form method="POST" action="{{ route('groups.update', $group->id) }}">
                @csrf
                @method('PUT')

                <!-- Naziv -->
                <div class="mb-4">
                    <label class="block text-indigo-700 font-medium mb-1">Naziv grupe</label>
                    <input type="text" name="name" value="{{ $group->name }}"
                           class="w-full rounded-xl px-3 py-2 bg-white/70 border border-white/40 focus:ring-indigo-300 focus:border-indigo-400 transition">
                </div>

                <!-- Opis -->
                <div class="mb-6">
                    <label class="block text-indigo-700 font-medium mb-1">Opis</label>
                    <textarea name="description"
                              class="w-full rounded-xl px-3 py-2 bg-white/70 border border-white/40 focus:ring-indigo-300 focus:border-indigo-400 transition">{{ $group->description }}</textarea>
                </div>

                <!-- Akcije -->
                <div class="flex gap-4">

                    <button type="submit"
                            class="px-6 py-2 rounded-xl bg-indigo-300 text-indigo-900 font-semibold shadow hover:bg-indigo-200 hover:scale-105 transition">
                        Spremi promjene
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
