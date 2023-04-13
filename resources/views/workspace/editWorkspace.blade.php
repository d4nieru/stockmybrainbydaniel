@extends('components.layout')
@section('content')

<h1 style="text-align: center">Vous etes en train de modifier le tableau {{ $workspace->workspace_name }}</h1>
<br>

<form method="POST" enctype="multipart/form-data" action="/posteditworkspace/{{ $workspace->id }}" style="text-align: center">
    @csrf
    Nouveau nom de l'espace de travail: <input type="text" name="new_workspace_name">
    Nouvelle Image de couverture (optionnel): <input type="file" id="new_workspace_cover" name="new_workspace_cover" accept="image/png, image/jpeg"> (10MB max.)
    <button type="submit" class="button-24" id="accept">Effectuer les modifications</button>
</form>

@endsection