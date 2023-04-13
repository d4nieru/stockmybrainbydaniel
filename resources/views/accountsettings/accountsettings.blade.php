@extends('components.layout')
@section('content')

<h1 style="text-align:center">Paramètres du compte</h1>
<br>
<br>

<div>
    <h3 style="text-align:center">Modification des informations personnelles</h3>

    <form method="POST" action="{{ route('user-profile-information.update') }}" style="text-align:center">
        @csrf
        @method('PUT')

        @if (session('status'))
            <p>Profile updated successfully.</p>
        @endif

        Nom : <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? auth()->user()->name }}" required autocomplete="name" autofocus>
        @error('name')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        Email : <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? auth()->user()->email }}" required autocomplete="email" autofocus>
        @error('email')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <button type="submit" class="button-24" id="accept">{{ __('Enregistrer les modifications') }}</button>
    </form>

    <br>
    <br>

    <h3 style="text-align:center">Modification du mot de passe</h3>

    <form method="POST" action="{{ route('user-password.update') }}" style="text-align:center">
        @csrf
        @method('PUT')

        @if (session('status') == "password-updated")
            <p>Password updated successfully.</p>
        @endif

        Mot de passe actuel : <input id="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required autofocus>
        @error('current_password', 'updatePassword')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        Nouveau Mot de passe : <input id="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password">
        @error('password', 'updatePassword')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        Retapez le Nouveau Mot de passe : <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        <button type="submit" class="button-24" id="accept">{{ __('Enregistrer les modifications') }}</button>
    </form>
</div>

@endsection