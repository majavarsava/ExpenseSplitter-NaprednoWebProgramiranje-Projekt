@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-6">

    <!-- Back -->
    <a href="{{ route('groups.index') }}"
       class="text-blue-500 hover:underline">← Natrag na grupe</a>

    <!-- Header -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-2">Stanje dugova – {{ $group->name }}</h2>
        <p class="text-gray-600">Ukupni trošak: <strong>{{ $total }} €</strong></p>
        <p class="text-gray-600">Prosjek po osobi: <strong>{{ number_format($average, 2) }} €</strong></p>
    </div>

    <!-- Balances table -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4">Pregled po korisnicima</h3>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">Korisnik</th>
                    <th class="p-2">Balans</th>
                </tr>
            </thead>
            <tbody>
            @foreach($balances as $user => $balance)
                <tr class="border-t">
                    <td class="p-2">{{ $user }}</td>
                    <td class="p-2">
                        @if($balance > 0)
                            <span class="text-green-600 font-semibold">+{{ $balance }} € (treba dobiti)</span>
                        @elseif($balance < 0)
                            <span class="text-red-600 font-semibold">{{ $balance }} € (duguje)</span>
                        @else
                            <span class="text-gray-500">0 € (izjednačeno)</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Settlements -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-3">Preporučene uplate</h3>

        <ul class="list-disc ml-6 space-y-1">
            @foreach($settlements as $s)
                <li>{{ $s }}</li>
            @endforeach
        </ul>

        <a href="{{ route('groups.settlements.index', $group->id) }}"
           class="inline-block mt-4 bg-indigo-500 text-black px-4 py-2 rounded hover:bg-indigo-600">
            Evidencija uplata
        </a>
    </div>

</div>
@endsection
