@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-8">

    <!-- Back -->
    <a href="{{ route('groups.index') }}"
       class="text-indigo-600 hover:text-indigo-800 hover:underline transition">
        ← Natrag na grupe
    </a>

    <!-- Header -->
    <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-8">
        <h2 class="text-3xl font-extrabold text-indigo-700 mb-2 drop-shadow-sm">
            Stanje dugova – {{ $group->name }}
        </h2>

        <p class="text-gray-700">
            Ukupni trošak:
            <strong class="text-indigo-700">{{ $total }} €</strong>
        </p>
    </div>

    <!-- Balances table -->
    <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-8">
        <h3 class="text-2xl font-semibold text-indigo-700 mb-4">
            Pregled po korisnicima
        </h3>

        <table class="w-full border-collapse rounded-xl overflow-hidden">
            <thead>
                <tr class="bg-indigo-100 text-indigo-900">
                    <th class="p-3 text-left">Korisnik</th>
                    <th class="p-3 text-left">Balans</th>
                </tr>
            </thead>

            <tbody>
            @foreach($balances as $user => $balance)
                <tr class="border-t border-white/40">
                    <td class="p-3 text-gray-700">{{ $user }}</td>
                    <td class="p-3">

                        @if($balance > 0)
                            <span class="text-emerald-700 font-semibold">
                                +{{ $balance }} € (treba dobiti)
                            </span>

                        @elseif($balance < 0)
                            <span class="text-rose-700 font-semibold">
                                {{ $balance }} € (duguje)
                            </span>

                        @else
                            <span class="text-gray-600">
                                0 € (izjednačeno)
                            </span>
                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Settlements -->
    <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-8">
        <h3 class="text-2xl font-semibold text-indigo-700 mb-3">
            Preporučene uplate
        </h3>

        <ul class="list-disc ml-6 space-y-1 text-gray-700">
            @foreach($settlements as $s)
                <li>{{ $s }}</li>
            @endforeach
        </ul>

        <a href="{{ route('groups.settlements.index', $group->id) }}"
           class="inline-block mt-4 px-6 py-2 rounded-xl bg-indigo-300 text-indigo-900 font-semibold shadow hover:bg-indigo-200 hover:scale-105 transition">
            Evidencija uplata
        </a>
    </div>

</div>
@endsection
