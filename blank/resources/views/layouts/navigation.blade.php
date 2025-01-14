<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">
            Home
        </a>

        <!-- User Info -->
        <div class="d-flex align-items-center">
            <span class="font-weight-high mr-3">{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
            <form method="POST" action="{{ route('logout') }}" class="d-inline-block">
                @csrf
                <button type="submit" class="btn btn-success">Logout</button>
            </form>
        </div>
    </div>
</nav>
