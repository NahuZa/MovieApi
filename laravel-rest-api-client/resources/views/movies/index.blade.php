@extends('layouts.app')

@section('content')
    <h1>Filmek listája</h1>

    @if($entities)
        <ul>
            @foreach($entities as $movie)
                <li>{{ $movie['name'] }} ({{ $movie['year'] }})</li>
            @endforeach
        </ul>
    @else
        <p>Nincs elérhető film.</p>
    @endif
@endsection
