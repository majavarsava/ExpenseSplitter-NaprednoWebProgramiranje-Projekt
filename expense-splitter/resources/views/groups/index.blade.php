@extends('layouts.app')

@section('content')
<h2>Moje grupe</h2>

<a href="{{ route('groups.create') }}">Dodaj novu grupu</a>

<ul>
@foreach($groups as $group)
    <li>
        {{ $group->name }}
        <a href="{{ route('groups.edit', $group->id) }}">Uredi</a>

        <form action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Obriši</button>
        </form>
    </li>
@endforeach
</ul>
@endsection
