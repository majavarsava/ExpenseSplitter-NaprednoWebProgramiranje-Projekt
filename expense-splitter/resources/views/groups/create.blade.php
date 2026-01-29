@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Nova grupa
</h2>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Back link -->
        <div>
            <a href="{{ route('groups.index') }}"
               class="text-blue-600 hover:underline flex items-center">
                ← Natrag na grupe
            </a>
        </div>

        <!-- Create group card -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-6 text-gray-800">
                Kreiraj novu grupu
            </h3>

            <form method="POST" action="{{ route('groups.store') }}" class="space-y-6">
                @csrf

                <!-- Group name -->
                <div>
                    <label class="block text-gray-700 mb-1">Naziv grupe</label>
                    <input type="text" name="name"
                           class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
                           placeholder="Unesi naziv grupe" required>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-gray-700 mb-1">Opis</label>
                    <textarea name="description"
                              class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
                              placeholder="Opis grupe"></textarea>
                </div>

                <!-- Members select -->
                <div>
                    <label class="block text-gray-700 mb-2">Dodaj članove u grupu</label>

                    <select name="users[]" multiple
                            class="w-full border rounded px-4 py-2 h-48">

                        @foreach($users as $user)
                            @if($user->id !== auth()->id())
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endif
                        @endforeach

                    </select>

                    <p class="text-sm text-gray-500 mt-1">
                        Drži CTRL (Windows) ili CMD (Mac) za odabir više članova.
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit"
                            class="bg-green-500 text-black px-6 py-2 rounded hover:bg-green-600 transition">
                        Spremi grupu
                    </button>

                    <a href="{{ route('groups.index') }}"
                       class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400 transition">
                        Nazad
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
