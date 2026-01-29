@extends('layouts.app')

@section('content')
<h2>Uplate – grupa: {{ $group->name }}</h2>

<h3>Dodaj novu uplatu</h3>

<form method="POST" action="{{ route('groups.settlements.store', $group->id) }}">
@csrf

<select name="from_user_id">
@foreach($users as $user)
    <option value="{{ $user->id }}">{{ $user->name }} (plaća)</option>
@endforeach
</select>

<select name="to_user_id">
@foreach($users as $user)
    <option value="{{ $user->id }}">{{ $user->name }} (prima)</option>
@endforeach
</select>

<input type="number" step="0.01" name="amount" placeholder="Iznos">
<input type="date" name="date">

<button type="submit">Spremi uplatu</button>
</form>

<hr>

<h3>Povijest uplata</h3>

<table border="1">
<tr>
    <th>Od</th>
    <th>Prema</th>
    <th>Iznos</th>
    <th>Datum</th>
    <th>Akcija</th>
</tr>

@foreach($settlements as $s)
<tr>
    <td>{{ $s->fromUser->name }}</td>
    <td>{{ $s->toUser->name }}</td>
    <td>{{ $s->amount }} €</td>
    <td>{{ $s->date }}</td>
    <td>
        <form method="POST" action="{{ route('groups.settlements.destroy', [$group->id, $s->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Obriši</button>
        </form>
    </td>
</tr>
@endforeach
</table>

@endsection
