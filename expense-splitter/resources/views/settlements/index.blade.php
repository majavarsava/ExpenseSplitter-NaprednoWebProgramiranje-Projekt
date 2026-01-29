@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-8">

    <!-- Back link -->
    <a href="{{ route('groups.balances', $group->id) }}"
       class="text-indigo-600 hover:text-indigo-800 hover:underline transition">
        ← Natrag na dugove
    </a>

    <!-- Add payment card -->
    <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-8">
        <h2 class="text-3xl font-extrabold text-indigo-700 mb-4">
            Uplate – {{ $group->name }}
        </h2>

        <h3 class="text-xl font-semibold text-indigo-700 mb-3">
            Dodaj novu uplatu
        </h3>

        <form method="POST" action="{{ route('groups.settlements.store', $group->id) }}"
              class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @csrf

            <select name="to_user_id"
                    class="rounded-xl px-4 py-2 bg-white/70 border border-white/40 focus:ring-indigo-300 focus:border-indigo-400 transition">
                @foreach($users as $user)
                    @if($user->id !== auth()->id())
                        <option value="{{ $user->id }}">{{ $user->name }} (prima)</option>
                    @endif
                @endforeach
            </select>

            <input type="number" step="0.01" name="amount" placeholder="Iznos"
                   class="rounded-xl px-4 py-2 bg-white/70 border border-white/40 focus:ring-indigo-300 focus:border-indigo-400 transition">

            <input type="date" name="date"
                   class="rounded-xl px-4 py-2 bg-white/70 border border-white/40 focus:ring-indigo-300 focus:border-indigo-400 transition">

            <button type="submit"
                class="md:col-span-4 px-6 py-2 rounded-xl bg-emerald-300 text-emerald-900 font-semibold shadow hover:bg-emerald-200 hover:scale-105 transition">
                Spremi uplatu
            </button>
        </form>
    </div>

    <!-- History card -->
    <div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-md rounded-2xl p-8">
        <h3 class="text-2xl font-semibold text-indigo-700 mb-4">
            Povijest uplata
        </h3>

        <table class="w-full border-collapse rounded-xl overflow-hidden">
            <thead>
                <tr class="bg-indigo-100 text-indigo-900">
                    <th class="p-3 text-left">Od</th>
                    <th class="p-3 text-left">Prema</th>
                    <th class="p-3 text-left">Iznos</th>
                    <th class="p-3 text-left">Datum</th>
                    <th class="p-3 text-left">Akcija</th>
                </tr>
            </thead>

            <tbody>
            @foreach($settlements as $s)
                <tr class="border-t border-white/40">
                    <td class="p-3 text-gray-700">{{ $s->fromUser->name }}</td>
                    <td class="p-3 text-gray-700">{{ $s->toUser->name }}</td>
                    <td class="p-3 text-gray-700">{{ $s->amount }} €</td>
                    <td class="p-3 text-gray-700">{{ $s->date }}</td>
                    <td class="p-3">
                        <form method="POST"
                              action="{{ route('groups.settlements.destroy', [$group->id, $s->id]) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="px-4 py-1 rounded-xl bg-rose-200 text-rose-900 font-semibold shadow hover:bg-rose-100 hover:scale-105 transition text-sm">
                                Obriši
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
