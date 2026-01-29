@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Uredi grupu
</h2>
@endsection

@section('content')
<br><br>
<div class="py-10">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white rounded-xl shadow p-8">

            <h2 class="text-2xl font-bold mb-6 text-gray-800">
                Uredi grupu: {{ $group->name }}
            </h2>

            <form method="POST" action="{{ route('groups.update', $group->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Naziv grupe</label>
                    <input type="text" name="name" value="{{ $group->name }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 mb-1">Opis</label>
                    <textarea name="description"
                              class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">{{ $group->description }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                            class="bg-blue-500 text-black px-6 py-2 rounded hover:bg-blue-600">
                        Spremi promjene
                    </button>

                    <a href="{{ route('groups.index') }}"
                       class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">
                        Nazad
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
