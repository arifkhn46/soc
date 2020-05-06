<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-menu container">
        <a class="navbar-item"> Classes </a>
        <a class="navbar-item"> Students </a>
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link"> Content Repository </a>
          <div class="navbar-dropdown">
            <a class="navbar-item" href="{{ route('teacher.content_repository.create') }}"> Create </a>
            <a class="navbar-item" href="{{ route('teacher.content_repository.list') }}"> List </a>
          </div>
        </div>
    </div>
</nav>