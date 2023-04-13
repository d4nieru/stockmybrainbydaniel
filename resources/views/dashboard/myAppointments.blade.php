@extends('components.layout')
@section('content')

<h1>Prochain rendez-vous à venir</h1>
<br>

@foreach ($user->appointments as $appointment)
    @if($appointment->is_active == true)
        <h1>{{ $appointment->meeting_date }} - {{ $appointment->meeting_time }}</h1>
        <h3>{{ $appointment->reason_for_the_meeting }}</h3>
        @if($appointment->videoconference_link == null)
            <p>Pas de lien pour la visio conférence</p>
        @else
            <p>Lien pour la visio conférence : </p>
            <a href="{{ $appointment->videoconference_link }}">
                <button class="button-24" id="info">Rejoindre la visioconférence</button>
            </a>
        @endif
    @endif
@endforeach
<br>
<br>

<h1>Les rendez-vous passés</h1>
<br>

@foreach ($user->appointments as $appointment)
    @if($appointment->is_active == false)
        <h1>{{ $appointment->meeting_date }} - {{ $appointment->meeting_time }}</h1>
        <h3>{{ $appointment->reason_for_the_meeting }}</h3>
    @endif
@endforeach

@endsection