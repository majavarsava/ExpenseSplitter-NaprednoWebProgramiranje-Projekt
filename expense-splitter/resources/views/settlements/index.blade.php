@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-6">

    <a href="{{ route('groups.balances', $group->id) }}"
       class="text-blue-500 hover:underline">← Natrag na dugove</a>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Uplate – {{ $group->name }}</h2>

        <!-- Add payment -->
        <h3 class="text-lg font-semibold mb-3">Dodaj novu uplatu</h3>

        <form method="POST" action="{{ route('groups.settlements.store', $group->id) }}"
              class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @csrf

            <select name="from_user_id" class="border rounded p-2">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} (plaća)</option>
                @endforeach
            </select>

            <select name="to_user_id" class="border rounded p-2">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} (prima)</option>
                @endforeach
            </select>

            <input type="number" step="0.01" name="amount" placeholder="Iznos"
                   class="border rounded p-2">

            <input type="date" name="date" class="border rounded p-2">

            <button type="submit"
                class="md:col-span-4 bg-green-500 text-black px-4 py-2 rounded hover:bg-green-600">
                Spremi uplatu
            </button>
        </form>
    </div>

    <!-- History -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4">Povijest uplata</h3>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">Od</th>
                    <th class="p-2">Prema</th>
                    <th class="p-2">Iznos</th>
                    <th class="p-2">Datum</th>
                    <th class="p-2">Akcija</th>
                </tr>
            </thead>
            <tbody>
            @foreach($settlements as $s)
                <tr class="border-t">
                    <td class="p-2">{{ $s->fromUser->name }}</td>
                    <td class="p-2">{{ $s->toUser->name }}</td>
                    <td class="p-2">{{ $s->amount }} €</td>
                    <td class="p-2">{{ $s->date }}</td>
                    <td class="p-2">
                        <form method="POST" action="{{ route('groups.settlements.destroy', [$group->id, $s->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-black px-3 py-1 rounded hover:bg-red-600">
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
