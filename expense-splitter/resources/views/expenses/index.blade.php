@extends('layouts.app')

@section('content')
<a href="{{ route('groups.index') }}">← Natrag na grupe</a>
<br><br>

<h2>Troškovi grupe: {{ $group->name }}</h2>

<a href="{{ route('groups.expenses.create', $group->id) }}">Dodaj trošak</a>

<table border="1">
<tr>
    <th>Naziv</th>
    <th>Iznos</th>
    <th>Datum</th>
    <th>Platio</th>
    <th>Akcije</th>
</tr>

@foreach($expenses as $expense)
<tr>
    <td>{{ $expense->title }}</td>
    <td>{{ $expense->amount }} €</td>
    <td>{{ $expense->date }}</td>
    <td>{{ $expense->user->name }}</td>
    <td>
        <a href="{{ route('groups.expenses.edit', [$group->id, $expense->id]) }}">Uredi</a>

        <form method="POST" action="{{ route('groups.expenses.destroy', [$group->id, $expense->id]) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Obriši</button>
        </form>
    </td>
</tr>
@endforeach
</table>
<br><br>
<a href="{{ route('groups.balances', $group->id) }}">Izračun dugova</a>

@endsection
