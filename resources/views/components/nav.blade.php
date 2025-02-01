<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Support Ticket System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Auth::user())
                    <li class="nav-item">
                        <a class="nav-link active mt-1" aria-current="page"
                            href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @endif
            </ul>

            @if (Auth::user())
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hi {{ Auth::user()->name }} !
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                @method('POST')

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();" class="text-decoration-none">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <span><a class="btn btn-outline-dark" href="{{ route('login') }}">Login</a></span> <span><a
                        class="ms-2 btn btn-outline-dark" href="{{ route('register') }}">Register</a></span>
            @endif

        </div>
    </div>
</nav>
