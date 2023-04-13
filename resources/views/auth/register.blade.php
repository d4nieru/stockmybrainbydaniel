@extends('components.mainpagelayout')
@section('content')

<div class="login-page">
    <div class="form">
      <form class="login-form" method="POST" action="/register">
        @csrf
        <input type="text" name="name" placeholder="Nom"/>
        <input type="email" name="email" placeholder="Email"/>
        <input type="password" name="password" placeholder="Mot de passe"/>
        <input type="password" name="password_confirmation" placeholder="Confirmer Mot de passe"/>
        <button type="submit">Créer un compte</button>
      </form>
      <p class="message">Vous possedez un compte ? <a href="/login">Se connecter</a></p>
    </div>
    <div class="footer">
      <p>© 2023 {{ $title }}. Tous droits réservés.</p>
    </div>
</div>

@endsection