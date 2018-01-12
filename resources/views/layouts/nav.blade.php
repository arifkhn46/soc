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
            <div class="navbar-start">
                @guest 

                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            Dashboard
                        </a>
                        <div class="navbar-dropdown">
                        </div>
                    </div>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            Courses
                        </a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{ route('course.type.create') }}">Course Types</a>
                            <a class="navbar-item" href="{{ route('courses.create') }}">Create a courses</a>
                        </div>
                    </div>
                @endguest
            </div>
            <div class="navbar-end">
                @guest
                    <a class="navbar-item" href="{{ route('login') }}">Login</a>
                    <a class="navbar-item" href="{{ route('register') }}">Register</a>
                @else
                    <a class="navbar-item" href="#">
                        Welcome, {{ Auth::user()->name }}
                    </a>
                    <a class="navbar-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                            Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                @endguest                    
            </div>
        </div>
    </div>
</nav>