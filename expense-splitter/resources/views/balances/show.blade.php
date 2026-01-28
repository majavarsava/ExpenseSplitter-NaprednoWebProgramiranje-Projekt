@extends('layouts.app')

@section('content')
<a href="{{ route('groups.index') }}">← Natrag na grupe</a>
<br><br>

<h2>Stanje dugova – grupa: {{ $group->name }}</h2>

<p>Ukupni trošak: {{ $total }} €</p>
<p>Prosjek po osobi: {{ number_format($average, 2) }} €</p>

<table border="1">
<tr>
    <th>Korisnik</th>
    <th>Balans</th>
</tr>

@foreach($balances as $user => $balance)
<tr>
    <td>{{ $user }}</td>
    <td>
        @if($balance > 0)
            +{{ $balance }} € (treba dobiti)
        @elseif($balance < 0)
            {{ $balance }} € (duguje)
        @else
            0 € (izjednačeno)
        @endif
    </td>
</tr>
@endforeach
</table>
<br>
<h3>Preporučene uplate:</h3>

<ul>
@foreach($settlements as $s)
    <li>{{ $s }}</li>
@endforeach
</ul>


@endsection
