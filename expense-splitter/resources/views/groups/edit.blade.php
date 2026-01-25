@extends('layouts.app')

@section('content')
<h2>Uredi grupu</h2>

<form method="POST" action="{{ route('groups.update', $group->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $group->name }}"><br><br>
    <textarea name="description">{{ $group->description }}</textarea><br><br>

    <button type="submit">Spremi</button>
</form>
@endsection
