@extends('components.layout')
@section('content')

<h1 style="text-align:center">Planification de Rendez-vous</h1>
<br>

<form method="POST" enctype="multipart/form-data" action="/postcreateappointment/{{ $workspace->id }}" style="text-align:center">
    @csrf
    <label for="meeting_label">Un rendez-vous pour :</label>
    <select name="user_id">
        <option selected disabled>--Choisissez le collaborateur--</option>
        @foreach ($workspace->users as $user)
            @if($user->id != Auth::id())
                <option value="{{ $user->id }}">
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endif
        @endforeach
    </select>
    <label for="reason_for_the_meeting">La nature du rendez-vous :</label>
    <input type="text" name="reason_for_the_meeting">
    <label for="meeting_time">Choisissez la date et l'heure pour le rendez-vous :</label>
    <input type="date" name="meeting_date" min="<?=date('Y-m-d')?>">
    <input type="time" name="meeting_time">
    <button type="submit" class="button-24" id="accept" onclick="return confirm('Etes-vous sur ?')">Planifier le rendez-vous</button>
</form>

@endsection