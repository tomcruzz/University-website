<!DOCTYPE html>
<html>
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="{{asset('css/wp.css')}}">
</head>
<body>
    @auth
      <span>{{ Auth::user()->name }}</span>
          <form action="{{ route('logout') }}" method="POST" style="display:inline;">
              @csrf
              <button type="submit">Logout</button>
          </form>

        
    @else
      <a href="{{ route('login') }}">Login</a>
      <a href="{{ route('register') }}">Register</a>
    @endauth
  @yield('content')
</body>
</html>