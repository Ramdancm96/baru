<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
  </head>
  <body>
    <header>
      <nav>
        <a href="/">Home</a>
        <a href="/blog">Blog</a>
      </nav>
    </header>
    @yield('content')
    <footer>
      <p>
        &copy: Laravel & Ramdan Chandra M 2017
      </p>
    </footer>
  </body>
</html>
