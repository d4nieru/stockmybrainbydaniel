@extends('components.layout')
@section('content')

<h1>Modification de la Tâche</h1>

    <form action="/edittask/{{$task["id"]}}" method="post">
        @csrf

        <input type="text" name="name" placeholder="Nom de la tâche" value="{{ $task->name }}">

        <textarea name="description" placeholder="Déscription de la tâche" value="{{ $task->description }}"></textarea>

        {{-- <input type="date" name="date" placeholder="Date de création"> --}}

        <select name="importance">
            <option selected disabled>--Choisissez l'importance de la tâche'--</option>
            <option value="not_urgent">Pas urgent</option>
            <option value="not_very_urgent">Peu urgent</option>
            <option value="urgent">Urgent</option>
            <option value="very_urgent">Très Urgent</option>
            <option value="to_be_done_in_priority">À Faire en Priorité</option>
        </select>

        <input type="submit" name='sub' value="Enregistrer la modification">

    </form>

@endsection