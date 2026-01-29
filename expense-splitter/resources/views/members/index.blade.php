@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Članovi grupe: {{ $group->name }}
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

        <!-- Add member card -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">
                Dodaj novog člana
            </h3>

            <form method="POST" action="{{ route('groups.members.store', $group->id) }}"
                  class="flex flex-col md:flex-row gap-4">
                @csrf

                <select name="user_id"
                        class="border rounded px-4 py-2 w-full md:w-2/3">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="bg-green-500 text-black px-6 py-2 rounded hover:bg-green-600 transition">
                    + Dodaj člana
                </button>
            </form>
        </div>

        <!-- Members list card -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">
                Postojeći članovi
            </h3>

            @if($group->users->count() == 0)
                <p class="text-gray-500">Još nema članova u ovoj grupi.</p>
            @else
                <ul class="divide-y">
                    @foreach($group->users as $user)
                        <li class="flex justify-between items-center py-3">

                            <div>
                                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>

                            <form method="POST"
                                  action="{{ route('groups.members.destroy', [$group->id, $user->id]) }}"
                                  onsubmit="return confirm('Sigurno želiš ukloniti ovog člana?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-500 text-black px-4 py-1 rounded hover:bg-red-600 transition text-sm">
                                    Ukloni
                                </button>
                            </form>

                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
</div>
@endsection
