@extends('components.layout')
@section('content')

<h1 style="text-align: center">GERER LES UTILISATEURS</h1>
<br>

<h3 style="text-align: center">Vous vous trouvez sur le tableau : {{ $workspace->workspace_name }}</h3>
<br>

@foreach ($workspace->users as $usr )
    @if($usr->pivot->ownership == 1 && $usr->id == $user_id || $usr->pivot->admin == 1 && $usr->id == $user_id)
        <form method="POST" enctype="multipart/form-data" action="/addusertoworkspace/{{ $workspace->id }}">
            @csrf
            Email: <input type="text" name="email">
            <button type="submit" class="button-24" id="accept">Ajouter le membre dans l'espace de travail</button>
        </form>
        <br>
    @endif

    @if($usr->id == $user_id) <b>(Vous)</b> {{ $usr->name }} - ({{ $usr->email }}) | @if($usr->pivot->ownership == 1 || $usr->pivot->ownership == 1 && $usr->pivot->admin == 1) <b>Propriétaire</b>
    @elseif($usr->pivot->admin == 1) <b>Administrateur</b> @else <b>Collaborateur</b> @endif<br> @endif
@endforeach

<p>---</p>
<br>

@foreach ($workspace->users as $usern)

    @if($usern->id != $user_id)
        {{ $usern->name }} ({{ $usern->email }}) @if($usern->pivot->ownership == 1) - <b>Propriétaire</b> @elseif($usern->pivot->admin == 1) - <b>Superviseur</b> @else - <b>Collaborateur</b> @endif
    
        @if($usern->id != $user_id && $usern->pivot->ownership == 0)
            <form method="POST" action="/changerole/{{ $workspace->id }}/{{ $usern->id }}">
                @csrf
                <select name="userrole">
                    <option selected disabled>--Choisissez le role--</option>
                    <option value="admin">Administrateur</option>
                    <option value="contributor">Collaborateur</option>
                </select>
                <input type="submit" name='sub' value="Sauvegarder" class="button-24" id="info"> 
            </form>
            
            <form method="POST" action="/transferownership/{{ $workspace->id }}/{{ $usern->id }}"
                onclick="return confirm('Vous voulez vraiment transférer de propriété ? (En cliquant sur OK, vous ne serez plus propriétaire du tableau)')">
                @csrf
                <button type="submit" class="button-24" id="modify">Transférer la propriété</button>
            </form>

            <form method="POST" action="/removeuserfromworkspace/{{ $workspace->id }}/{{ $usern->id }}"
                onclick="return confirm('Vous voulez vraiment le retirer ? (En cliquant sur OK, il/elle ne fera plus parti(e))')">
                @csrf
                <button type="submit" class="button-24">Retirer l'utilisateur du projet</button>
            </form>
        @endif
    @endif
    <br>
    <br>
    
@endforeach

@endsection