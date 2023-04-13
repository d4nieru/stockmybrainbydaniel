@extends('components.mainpagelayout')
@section('content')

<h1 style="text-align: center">Réinitialiser le mot de passe</h1>

<form method="POST" action="/reset-password" style="text-align: center">
    @csrf
    <input type="hidden" name="token" value="{{ request()->route('token') }}">
    Email: <input type="email" name="email"><br>
    Nouveau Mot de Passe: <input type="password" name="password"><br>
    Confirmez le Nouveau Mot de Passe: <input type="password" name="password_confirmation">
    <button type="submit" class="button-24" id="accept">Poursuivre</button>
</form>

