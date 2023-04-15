@extends('components.layout')
@section('content')

<h1>Prochain rendez-vous à venir</h1>
<br>

@foreach ($appointments as $appointment)
    @if($appointment->is_active == true && $appointment->host_of_the_meeting_id == Auth::id())
        <p>Nom du collaborateur :
        @inject('usr', 'App\Models\User')
        @php
            $usr = $usr->find($appointment->guest_of_the_meeting_id)
        @endphp
        {{ $usr->name }}</p>
        <p>Email du collaborateur : {{ $usr->email }}</p>
        <p>Date et l'Heure du rendez-vous : {{ $appointment->meeting_date }} - {{ $appointment->meeting_time }}</p>
        <p>Raison du rendez-vous : {{ $appointment->reason_for_the_meeting }}</p>
        @if($appointment->videoconference_link == null)
            <p>Pas de lien pour la visio conférence</p>
            <button class="button-24" id="generate-link-button" data-appointmentid="{{ $appointment->id }}">Générer le lien de visioconférence</button>
            {{-- <form method="POST" action="/generatelinkforvideoconference/{{ $appointment->id }}">
                @csrf
                <button type="submit" class="button-24" id="accept" id="generate-link-button" data-appointmentid="{{ $appointment->id }}" onclick="return confirm('Voulez-vous vraiment générer un lien pour la visioconférence ?')">Générer un lien pour une visionconférence</button>
            </form> --}}
        @else
            <p>Lien pour la visio conférence : </p>
            <a href="{{ $appointment->videoconference_link }}" target="_blank">
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
    <p>Nom du collaborateur :
        @inject('usr', 'App\Models\User')
        @php
            $usr = $usr->find($appointment->guest_of_the_meeting_id)
        @endphp
        {{ $usr->name }}</p>
        <p>Email du collaborateur : {{ $usr->email }}</p>
        <p>Date et l'Heure du rendez-vous : {{ $appointment->meeting_date }} - {{ $appointment->meeting_time }}</p>
        <p>Raison du rendez-vous : {{ $appointment->reason_for_the_meeting }}</p>
        <br>
        <br>
    @endif
@endforeach

@endsection