@extends('components.layout')
@section('content')

<h1 style="text-align:center">VOS ESPACES DE TRAVAIL (+ ESPACES DE TRAVAIL D'INVITÉS)</h1>
<br>
<br>

<div style="text-align: center">
    @foreach($user->workspaces as $workspace)
        <a href="workspace/{{ $workspace->id }}">
            @if($workspace->workspace_cover_name == null)
                <img src="https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg">
            @else
                <img src="{{ asset('workspaceimgs/'.$workspace->workspace_cover_name) }}">
                <form method="POST" action="/deleteworkspacecover/{{ $workspace->id }}">
                    @csrf
                    <button type='submit' onclick="return confirm(`Voulez-vous vraiment supprimer l'image de couverture ?`)">Supprimer l'image de couverture'</button>
                </form>
            @endif
        </a>
        <br>
        <h1>{{ $workspace->workspace_name }}</h1>
        <p>@if($workspace->pivot->ownership == 1) Role : Propriétaire @elseif ($workspace->pivot->admin == 1) Role : Admin/Superviseur @else Role : Collaborateur @endif</p>
        <br>

        @if($workspace->pivot->ownership == 1)
            <form method="GET" action="/bookinganappointment/{{ $workspace->id }}">
                @csrf
                <button type="submit" class="button-24" id="info">🖋️ Fixer un Rendez-vous pour un collaborateur</button>
            </form>
        @endif

        <form method="GET" action="/managemembers/{{ $workspace->id }}">
            @csrf
            <button type="submit" class="button-24" id="info">Gérer les membres</button>
        </form>

        @if($workspace->pivot->admin == 1 || $workspace->pivot->ownership == 1)
            <form method="GET" action="/editworkspace/{{ $workspace->id }}">
                @csrf
                <button type="submit" class="button-24" id="modify">Modifier l'espace de travail</button>
            </form>
        @endif
        
        @if($workspace->pivot->ownership == 1)
            <form method="POST" action="/deleteworkspace/{{ $workspace->id }}" onclick="return confirm('Vous voulez supprimer le tableau ? (En cliquant sur OK, tout sera supprimé définitivement)')">
                @csrf
                <button type="submit" class="button-24">Supprimer l'espace de travail</button>
            </form>
        @endif
        <br>
        <br>
        <br>
    @endforeach
</div>

@endsection