{{-- <header>
  <div>
    <div>
      <a href="/dashboard">
        <button>🏠 Page d'Accueil</button>
      </a>
    </div>
    <div>
      <a href="/createworkspace">
        <button>➕ Créer un espace de travail</button>
      </a>
    </div>
    <div>
      <a href="/bookinganappointment">
        <button>📓 Prendre un rendez-vous</button>
      </a>
    </div>
    <div>
      <a href="/settings">
        <button>⚙️ Gérer le compte</button>
      </a>
    </div>
    <div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">🚪🚶 Se déconnecter</button>
      </form>
    </div>
  </div>
</header> --}}

<nav class="navbar">
  <a href="/" class="navbar-logo">Logo</a>
  <button class="navbar-toggle">
    <span class="navbar-toggle-icon"></span>
  </button>
  <ul class="navbar-links">
    <li><a href="/dashboard">🏠 Page d'Accueil</a></li>
    <li><a href="/createworkspace">➕ Créer un espace de travail</a></li>
    <li><a href="/manageappointments">🧵 Gérer les rendez-vous</a></li>
    <li><a href="/myappointments">📓 Mes Rendez-vous</a></li>
    <li><a href="/settings">⚙️ Gérer le compte</a></li>
    <li>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="button-24" role="button">🚪🚶 Se déconnecter</button>
      </form>
    </li>
  </ul>
</nav>

<br>
<br>
<br>