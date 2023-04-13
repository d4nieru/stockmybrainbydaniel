@extends('components.layout')
@section('content')

<h1 style="text-align:center">Creation de l'espace de travail</h1>
<br>

<form class="create-workspace-form" method="POST" enctype="multipart/form-data" action="/postcreateworkspace" style="text-align:center">
    @csrf
    <label for="workspace-name-input">Nom de l'espace de travail:</label>
    <input type="text" id="workspace-name-input" name="workspace_name">
    <label for="workspace-cover-input">Image de couverture (optionnel):</label>
    <input type="file" id="workspace-cover-input" name="workspace_cover" accept="image/png, image/jpeg"> (10MB max.)
    <button type="submit" class="button-24" id="accept">Créer l'espace de travail</button>
</form>

@endsection