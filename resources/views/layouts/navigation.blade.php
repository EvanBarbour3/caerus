<nav class="navbar ">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            {{ config('app.name', 'Test') }}
        </a>

        <div id="navigationBurger" class="navbar-burger burger" data-target="navigation-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="navigation-menu" class="navbar-menu">
        <div class="navbar-start">

        </div>

        <div class="navbar-end">
            <a class="navbar-item" href="{{ route('orders') }}">
                Orders
            </a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    {{ Auth::user()->name }}
                </a>
                <div class="navbar-dropdown ">
                    <a class="navbar-item" href="/somewhere-to-your-account">
                        Account
                    </a>
                    <a class="navbar-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <hr class="navbar-divider">
                    <div class="navbar-item">
                        <div>version <span class="has-text-info">1.2.3</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
