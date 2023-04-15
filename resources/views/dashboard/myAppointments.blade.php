@extends('components.layout')
@section('content')

<h1>Prochain rendez-vous à venir</h1>
<br>

@foreach ($user->appointments as $appointment)
    @if($appointment->is_active == true)
        <p>Nom du collaborateur :
        @inject('usr', 'App\Models\User')
        @php
            $usr = $usr->find($appointment->host_of_the_meeting_id)
        @endphp
        {{ $usr->name }}</p>
        <p>Email du collaborateur : {{ $usr->email }}</p>
        <p>Date et l'Heure du rendez-vous : {{ $appointment->meeting_date }} - {{ $appointment->meeting_time }}</p>
        <p>Raison du rendez-vous : {{ $appointment->reason_for_the_meeting }}</p>
        @if($appointment->videoconference_link == null)
            
            <button type="button" class="button-24" disabled>Pas de lien pour la visio conférence</button>
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
        <p>Nom du collaborateur :
        @inject('usr', 'App\Models\User')
        @php
            $usr = $usr->find($appointment->host_of_the_meeting_id)
        @endphp
        {{ $usr->name }}</p>
        <p>Email du collaborateur : {{ $usr->email }}</p>
        <p>Date et l'Heure du rendez-vous : {{ $appointment->meeting_date }} - {{ $appointment->meeting_time }}</p>
        <p>Raison du rendez-vous : {{ $appointment->reason_for_the_meeting }}</p>
    @endif
@endforeach

@endsection