@extends('layouts.app')

@section('content')
<h2>Novi trošak</h2>

<form method="POST" action="{{ route('groups.expenses.store', $group->id) }}">
@csrf
<input type="text" name="title" placeholder="Naziv"><br><br>
<input type="number" step="0.01" name="amount" placeholder="Iznos"><br><br>
<input type="date" name="date"><br><br>
<textarea name="description" placeholder="Opis"></textarea><br><br>
<button type="submit">Spremi</button>
</form>
@endsection
