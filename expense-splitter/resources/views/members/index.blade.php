@extends('layouts.app')

@section('content')
<h2>Članovi grupe: {{ $group->name }}</h2>

<h3>Dodaj člana</h3>
<form method="POST" action="{{ route('groups.members.store', $group->id) }}">
    @csrf
    <select name="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
        @endforeach
    </select>
    <button type="submit">Dodaj</button>
</form>

<hr>

<h3>Postojeći članovi</h3>
<ul>
@foreach($group->users as $user)
    <li>
        {{ $user->name }}

        <form method="POST" action="{{ route('groups.members.destroy', [$group->id, $user->id]) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Ukloni</button>
        </form>
    </li>
@endforeach
</ul>
<a href="{{ route('groups.index') }}"><button>Povratak na grupe</button></a>

@endsection
