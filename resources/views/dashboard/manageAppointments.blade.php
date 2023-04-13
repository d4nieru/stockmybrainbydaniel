@extends('components.layout')
@section('content')

<h1>Prochain rendez-vous à venir</h1>
<br>

@foreach ($appointments as $appointment)
    @if($appointment->is_active == true && $appointment->host_of_the_meeting_id == Auth::id())
        <h1>{{ $appointment->meeting_date }} - {{ $appointment->meeting_time }}</h1>
        <h3>{{ $appointment->reason_for_the_meeting }}</h3>
        @if($appointment->videoconference_link == null)
            <p>Pas de lien pour la visio conférence</p>
            <form method="POST" action="/generatelinkforvideoconference/{{ $appointment->id }}">
                @csrf
                <button type="submit" class="button-24" id="accept" id="generate-link-button" data-appointmentid="{{ $appointment->id }}" onclick="return confirm('Voulez-vous vraiment générer un lien pour la visioconférence ?')">Générer un lien pour une visionconférence</button>
            </form>
        @else
            <p>Lien pour la visio conférence : </p>
            <a href="{{ $appointment->videoconference_link }}">
                <button class="button-24" id="info">Rejoindre la visioconférence</button>
            </a>
            <form method="POST" action="/cancelappointment/{{ $appointment->id }}">
                @csrf
                <button type="submit" class="button-24" onclick="return confirm('Voulez-vous vraiment annuler le rendez-vous ?')">Annuler le rendez-vous</button>
            </form>
        @endif
    @endif
@endforeach
<br>
<br>

<h1>Les rendez-vous passés</h1>
<br>

@foreach ($appointments as $appointment)
    @if($appointment->is_active == false && $appointment->host_of_the_meeting_id == Auth::id())
        <h1>{{ $appointment->meeting_date }} - {{ $appointment->meeting_time }}</h1>
        <h3>{{ $appointment->reason_for_the_meeting }}</h3>
    @endif
@endforeach

@endsection