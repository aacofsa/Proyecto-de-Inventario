<html>

<head class>
  <title>Easy Control</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">EasyControl</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/login"> Iniciar Sesión </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/register"> Registrarse </a>
          </li>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</head>

<body>
  <div class="container">
    @yield('content')
  </div>
</body>

<footer class="bg-primary text-center text-white fixed-bottom">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/DreamyBit/03EasyControl" role="button"><i class="fab fa-github"></i></a>
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2022 Copyright: EasyControl
    </div>
    <!-- Copyright -->
</footer>

</html>