@extends('layouts.app')

@section('content')
<h2>Nova grupa</h2>

<form method="POST" action="{{ route('groups.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Naziv grupe"><br><br>
    <textarea name="description" placeholder="Opis"></textarea><br><br>
    <button type="submit">Spremi</button>
</form>
@endsection
