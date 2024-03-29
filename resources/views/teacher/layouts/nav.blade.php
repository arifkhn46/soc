<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <!-- Branding Image -->
            <a class="navbar-item" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <button class="button navbar-burger">
            <span></span>
            <span></span>
            <span></span>
            </button>
        </div>
        <div id="soc-menu" class="navbar-menu">
            <!-- <div class="navbar-start">
                @guest

                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                                Content Repository
                        </a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{ route('teacher.content_repository.create') }}">Create</a>
                            <a class="navbar-item" href="{{ route('teacher.content_repository.list') }}">List</a>
                        </div>
                    </div>
                @endguest
            </div> -->
            <div class="navbar-end">
                @guest
                    <a class="navbar-item" href="{{ route('login') }}">Login</a>
                    <a class="navbar-item" href="{{ route('register') }}">Register</a>
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                                    Logout
                            </a>
                        </div>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>