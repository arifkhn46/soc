<aside class="menu">
  <p class="menu-label">
    Administration
  </p>
  <ul class="menu-list">
    <li class="menu-item">
      <a class="menu-link {{ Request::is('roles/*') || Request::is('roles') ? 'is-active' : '' }}">Role</a>
        <ul>
          <li><a href="{{ route('roles.list') }}">List</a></li>
          <li><a href="{{ route('roles.create') }}">Create</a></li>
        </ul>
      </a>
      <a class="menu-link {{ Request::is('courses/*') || Request::is('courses') ? 'is-active' : '' }}">Courses</a>
        <ul>
          <li><a href="{{ route('course.create') }}">Create</a></li>
        </ul>
      </a>
    </li>
  </ul>
</aside>