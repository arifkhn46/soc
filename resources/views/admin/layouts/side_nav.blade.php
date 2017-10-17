<aside class="menu">
  <p class="menu-label">
    Administration
  </p>
  <ul class="menu-list">
    <li class="menu-item">
      <a class="menu-link {{ Request::is('roles/*') ? 'is-active' : '' }}">Role</a>
        <ul>
          <li><a href="{{ route('roles.create') }}">Create</a></li>
        </ul>
      </a>
  </ul>
</aside>