@extends('components.layout')
@section('content')

<h1 style="text-align:center">LES TÂCHES</h1>

<div>
    <form method="POST" action="/createtask/{{ $workspace->id }}">
        @csrf
        <input type="text" name="name" placeholder="Nom de la tâche">

        <textarea name="description" placeholder="Déscription de la tâche"></textarea>

        {{-- <input type="date" name="date" placeholder="Date de création"> --}}

        <select name="importance">
            <option selected disabled>--Choisissez l'importance de la tâche--</option>
            <option value="not_urgent">Pas urgent</option>
            <option value="not_very_urgent">Peu urgent</option>
            <option value="urgent">Urgent</option>
            <option value="very_urgent">Très Urgent</option>
            <option value="to_be_done_in_priority">À Faire en Priorité</option>
        </select>

        <input type="submit" name='sub' value="Ajouter une tâche">
    </form>
    <br>
    <br>
</div>

<div class="tasks_container">
    <div class="not_urgent_tasks">
        <h3>PAS URGENT</h3>
            @foreach ($workspace->tasks as $task)
                @if($task->importance == "not_urgent")
                    <br>
                    <br>
                    <div style="text-align:center">
                        <b>Nom de la tache :</b> <br> {{$task->name}} <br>
                        <b>Description :</b> <br> {{$task->description}} <br>
                        <b>Importance :</b> Pas Urgent <br>
                        <b>Créateur :</b> {{$task->creator}} <br>
                        <b>Date :</b> {{$task->created_at}} <br>
                        <b>Etat :</b> {{$task->status}} <br>

                        <form method="POST" action="/changetaskstatus/{{ $task["id"] }}">
                            @csrf
                            <select name="taskStatus">
                                <option selected disabled>--Choisissez l'etat de la tâche--</option>
                                <option value="Non Fait">Non Fait</option>
                                <option value="En Cours">En Cours</option>
                                <option value="À Retravailler">À Retravailler</option>
                                <option value="Terminé">Terminé</option>
                            </select>
                            <input type="submit" name='sub' value="Enregistrer">
                        </form>
                    
                        <form method="POST" action="/changetaskimportance/{{ $task["id"] }}">
                            @csrf
                            <select name="taskImportance">
                                <option selected disabled>--Choisissez l'importance de la tâche--</option>
                                <option value="not_urgent">Pas urgent</option>
                                <option value="not_very_urgent">Peu urgent</option>
                                <option value="urgent">Urgent</option>
                                <option value="very_urgent">Très Urgent</option>
                                <option value="to_be_done_in_priority">À Faire en Priorité</option>
                            </select>
                            <input type="submit" name='sub' value="Enregistrer">
                        </form>
                        <br>
                    
                        <form action="/edittask/{{$task["id"]}}" method="GET">
                            @csrf
                            <button type="submit" class="">Modifier la tâche</button>
                        </form>

                        @can('task_delete')
                            <form action="/deletetask/{{$task["id"]}}" method="POST">
                                @csrf
                                <button type="submit" class="">Supprimer la tâche</button>
                            </form>
                        @endcan
                    </div>
                @endif
            @endforeach
    </div>
    <div class="not_very_urgent_tasks">
        <h3>PEU URGENT</h3>
            @foreach ($workspace->tasks as $task)
                @if($task->importance == "not_very_urgent")
                    <br>
                    <br>
                    <div style="text-align:center">
                        <b>Nom de la tache :</b> {{$task->name}} <br>
                        <b>Description :</b> {{$task->description}} <br>
                        <b>Importance :</b> Peu Urgent <br>
                        <b>Créateur :</b> {{$task->creator}} <br>
                        <b>Date :</b> {{$task->created_at}} <br>
                        <b>Etat :</b> {{$task->status}} <br>

                        <form method="POST" action="/changetaskstatus/{{ $task["id"] }}">
                            @csrf
                            <select name="taskStatus">
                                <option selected disabled>--Choisissez l'etat de la tâche--</option>
                                <option value="Non Fait">Non Fait</option>
                                <option value="En Cours">En Cours</option>
                                <option value="À Retravailler">À Retravailler</option>
                                <option value="Terminé">Terminé</option>
                            </select>
                            <input type="submit" name='sub' value="Enregistrer">
                        </form>

                        <form method="POST" action="/changetaskimportance/{{ $task["id"] }}">
                            @csrf
                            <select name="taskImportance">
                                <option selected disabled>--Choisissez l'importance de la tâche--</option>
                                <option value="not_urgent">Pas urgent</option>
                                <option value="not_very_urgent">Peu urgent</option>
                                <option value="urgent">Urgent</option>
                                <option value="very_urgent">Très Urgent</option>
                                <option value="to_be_done_in_priority">À Faire en Priorité</option>
                            </select>
                            <input type="submit" name='sub' value="Enregistrer">
                        </form>
                        <br>
                    
                        <form action="/edittask/{{$task["id"]}}" method="GET">
                            @csrf
                            <button type="submit" class="">Modifier la tâche</button>
                        </form>

                        @can('task_delete')
                            <form action="/deletetask/{{$task["id"]}}" method="POST">
                                @csrf
                                <button type="submit" class="">Supprimer la tâche</button>
                            </form>
                        @endcan
                    </div>
                @endif
            @endforeach
    </div>
    <div class="urgent_tasks">
        <h3>URGENT</h3>
            @foreach ($workspace->tasks as $task)
                @if($task->importance == "urgent")
                    <br>
                    <br>
                    <div style="text-align:center">
                        <b>Nom de la tache :</b> {{$task->name}} <br>
                        <b>Description :</b> {{$task->description}} <br>
                        <b>Importance :</b> Urgent <br>
                        <b>Créateur :</b> {{$task->creator}} <br>
                        <b>Date :</b> {{$task->created_at}} <br>
                        <b>Etat :</b> {{$task->status}} <br>

                        <form method="POST" action="/changetaskstatus/{{ $task["id"] }}">
                            @csrf
                            <select name="taskStatus">
                                <option selected disabled>--Choisissez l'etat de la tâche--</option>
                                <option value="Non Fait">Non Fait</option>
                                <option value="En Cours">En Cours</option>
                                <option value="À Retravailler">À Retravailler</option>
                                <option value="Terminé">Terminé</option>
                            </select>
                            <input type="submit" name='sub' value="Enregistrer">
                        </form>

                        <form method="POST" action="/changetaskimportance/{{ $task["id"] }}">
                            @csrf
                            <select name="taskImportance">
                                <option selected disabled>--Choisissez l'importance de la tâche--</option>
                                <option value="not_urgent">Pas urgent</option>
                                <option value="not_very_urgent">Peu urgent</option>
                                <option value="urgent">Urgent</option>
                                <option value="very_urgent">Très Urgent</option>
                                <option value="to_be_done_in_priority">À Faire en Priorité</option>
                            </select>
                            <input type="submit" name='sub' value="Enregistrer">
                        </form>
                        <br>
                    
                        <form action="/edittask/{{$task["id"]}}" method="GET">
                            @csrf
                            <button type="submit" class="">Modifier la tâche</button>
                        </form>

                        @can('task_delete')
                            <form action="/deletetask/{{$task["id"]}}" method="POST">
                                @csrf
                                <button type="submit" class="">Supprimer la tâche</button>
                            </form>
                        @endcan
                    </div>
                @endif
            @endforeach
    </div>
    <div class="very_urgent_tasks">
        <h3>TRÈS URGENT</h3>
            @foreach ($workspace->tasks as $task)
                @if($task->importance == "very_urgent")
                    <br>
                    <br>
                    <div style="text-align:center">
                        <b>Nom de la tache :</b> {{$task->name}} <br>
                        <b>Description :</b> {{$task->description}} <br>
                        <b>Importance :</b> Très Urgent <br>
                        <b>Créateur :</b> {{$task->creator}} <br>
                        <b>Date :</b> {{$task->created_at}} <br>
                        <b>Etat :</b> {{$task->status}} <br>

                        <form method="POST" action="/changetaskstatus/{{ $task["id"] }}">
                            @csrf
                            <select name="taskStatus">
                                <option selected disabled>--Choisissez l'etat de la tâche--</option>
                                <option value="Non Fait">Non Fait</option>
                                <option value="En Cours">En Cours</option>
                                <option value="À Retravailler">À Retravailler</option>
                                <option value="Terminé">Terminé</option>
                            </select>
                            <input type="submit" name='sub' value="Enregistrer">
                        </form>

                        <form method="POST" action="/changetaskimportance/{{ $task["id"] }}">
                            @csrf
                            <select name="taskImportance">
                                <option selected disabled>--Choisissez l'importance de la tâche--</option>
                                <option value="not_urgent">Pas urgent</option>
                                <option value="not_very_urgent">Peu urgent</option>
                                <option value="urgent">Urgent</option>
                                <option value="very_urgent">Très Urgent</option>
                                <option value="to_be_done_in_priority">À Faire en Priorité</option>
                            </select>
                            <input type="submit" name='sub' value="Enregistrer">
                        </form>
                        <br>
                    
                        <form action="/edittask/{{$task["id"]}}" method="GET">
                            @csrf
                            <button type="submit" class="">Modifier la tâche</button>
                        </form>

                        @can('task_delete')
                            <form action="/deletetask/{{$task["id"]}}" method="POST">
                                @csrf
                                <button type="submit" class="">Supprimer la tâche</button>
                            </form>
                        @endcan
                    </div>
                @endif
            @endforeach
    </div>
    <div class="to_be_done_in_priority_tasks">
        <h3>À FAIRE EN PRIORITÉ</h3>
            @foreach ($workspace->tasks as $task)
                @if($task->importance == "to_be_done_in_priority")
                    <br>
                    <br>
                    <div style="text-align:center">
                        <b>Nom de la tache :</b> {{$task->name}} <br>
                        <b>Description :</b> {{$task->description}} <br>
                        <b>Importance :</b> À Faire en Priorité <br>
                        <b>Créateur :</b> {{$task->creator}} <br>
                        <b>Date :</b> {{$task->created_at}} <br>
                        <b>Etat :</b> {{$task->status}} <br>

                        <form method="POST" action="/changetaskstatus/{{ $task["id"] }}">
                            @csrf
                            <select name="taskStatus">
                                <option selected disabled>--Choisissez l'etat de la tâche--</option>
                                <option value="Non Fait">Non Fait</option>
                                <option value="En Cours">En Cours</option>
                                <option value="À Retravailler">À Retravailler</option>
                                <option value="Terminé">Terminé</option>
                            </select>
                            <input type="submit" name='sub' value="Enregistrer">
                        </form>

                        <form method="POST" action="/changetaskimportance/{{ $task["id"] }}">
                            @csrf
                            <select name="taskImportance">
                                <option selected disabled>--Choisissez l'importance de la tâche--</option>
                                <option value="not_urgent">Pas urgent</option>
                                <option value="not_very_urgent">Peu urgent</option>
                                <option value="urgent">Urgent</option>
                                <option value="very_urgent">Très Urgent</option>
                                <option value="to_be_done_in_priority">À Faire en Priorité</option>
                            </select>
                            <input type="submit" name='sub' value="Enregistrer">
                        </form>
                        <br>
                    
                        <form action="/edittask/{{$task["id"]}}" method="GET">
                            @csrf
                            <button type="submit" class="">Modifier la tâche</button>
                        </form>

                        @can('task_delete')
                            <form action="/deletetask/{{$task["id"]}}" method="POST">
                                @csrf
                                <button type="submit" class="">Supprimer la tâche</button>
                            </form>
                        @endcan
                    </div>
                @endif
            @endforeach
    </div>
</div>

@endsection