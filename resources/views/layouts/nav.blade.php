<div id="header">
    <div class="flex bg-white border-b border-gray-200 h-16 text-gray-600 p-2 mt-0 fixed w-full z-10 pin-t" role="navigation" aria-label="main navigation">
        <div class="w-full px-16">
            <div class="w-full flex items-center h-full py-3">
                <div class="flex items-center h-full">
                    <!-- Branding Image -->
                    <a class="navbar-item hover:text-gray-900" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    <button class="button navbar-burger">
                    <span></span>
                    <span></span>
                    <span></span>
                    </button>
                </div>
                <div id="soc-menu" class="flex flex-grow items-center justify-end h-full">
                    <div class="navbar-start">
                        @guest

                        @else
                            <div class="navbar-item has-dropdown is-hoverable">
                                <!-- <a class="px-4 flex items-center hover:text-gray-900 h-full hover:bg-gray-100 rounded">
                                    Dashboard
                                </a> -->
                                <div class="navbar-dropdown">
                                </div>
                            </div>
                        @endguest
                    </div>
                    <div class="flex items-center h-full">
                        @guest
                            <a class="px-4 flex items-center hover:text-gray-900 h-full hover:bg-gray-100 rounded" href="{{ route('login') }}">Login</a>
                            <a class="px-4 flex items-center hover:text-gray-900 h-full hover:bg-gray-100 rounded" href="{{ route('register') }}">Register</a>
                        @else
                            <a class="px-4 flex items-center hover:text-gray-900 h-full hover:bg-gray-100 rounded" href="#">
                                Welcome, {{ Auth::user()->name }}
                            </a>
                            <a class="px-4 flex items-center hover:text-gray-900 h-full hover:bg-gray-100 rounded" href="{{ route('logout') }}"
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
        </div>
    </div>
</div>