@extends('layouts.app')

@section('content')
<h2>Uredi trošak</h2>

<form method="POST" action="{{ route('groups.expenses.update', [$group->id, $expense->id]) }}">
@csrf
@method('PUT')

<input type="text" name="title" value="{{ $expense->title }}"><br><br>
<input type="number" step="0.01" name="amount" value="{{ $expense->amount }}"><br><br>
<input type="date" name="date" value="{{ $expense->date }}"><br><br>
<textarea name="description">{{ $expense->description }}</textarea><br><br>

<button type="submit">Spremi</button>
</form>
@endsection
