@extends('components.mainpagelayout')
@section('content')


<div class="container">
  <div class="logo">
    <img src="./illustrations/SMG.png" alt="OpenAI logo">
  </div>
  <div class="button-container">
    @auth
        <a href="{{ url('/dashboard') }}">Accéder à votre tableau de bord</a>
        </a>
        @else
            <a href="/login">
              <button class="button button-login">Se connecter</button>
            </a>
            <a href="/register">
              <button class="button button-create-account">Créer un compte</button>
            </a>
    @endauth
  </div>
  <div class="footer">
    <p>© 2023 {{ $title }}. Tous droits réservés.</p>
  </div>
</div>

@endsection
