<style>
    .navbar {
        padding: 12px 0px;
        box-shadow: 0 0 10px 0 rgb(0 0 0 / 20%);
    }

    .active {
        color: #00b12b !important;
        font-weight: 900;
    }
</style>
<nav class="navbar navbar-expand-lg bg-white justify-content-end">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('logo2.png') }}" alt="" style="width: 40%;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('home') }}">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>