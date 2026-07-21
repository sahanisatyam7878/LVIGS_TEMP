<nav class="navbar navbar-expand-lg site-navbar">

    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <img class="brand-logo" src="{{ asset('images/lvigs image logo.jpeg') }}" alt="LVIGS MART">
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-house-door"></i>
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Login
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.login') }}">
                        <i class="bi bi-shield-lock"></i>
                        Admin
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gallery') }}">
                        <i class="bi bi-image"></i>
                        Gallery
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-invest" href="{{ route('investment') }}">
                        <i class="bi bi-graph-up-arrow"></i>
                        Investment
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('membership') }}">
                        <i class="bi bi-person-badge"></i>
                        Membership
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                <li class="nav-item">
                    <button class="theme-toggle" type="button" data-theme-toggle aria-label="Switch dark mode">
                        <i class="bi bi-moon-stars-fill theme-icon-dark"></i>
                        <i class="bi bi-sun-fill theme-icon-light"></i>
                    </button>
                </li>

            </ul>

        </div>

    </div>

</nav>
