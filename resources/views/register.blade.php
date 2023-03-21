<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
</head>
<body>
    <x-navbar :logged="session('logged')" :user="session('user')" />

<div class="contenedorMain">
      <div class="container col-4 contenedorForm pt-4 d-flex justify-content-center">
        <form class="formLogin cardLogin" method="POST" action="{{ route('userRegister') }}">
            @csrf
            <div class="card_headerLogin">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path fill="none" d="M0 0h24v24H0z"></path>
                <path fill="currentColor" d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z"></path>
              </svg>
              <h1 class="form_headingLogin">Registrarse</h1>
            </div>
            <div class="fieldLogin">
              <label for="username">Username</label>
              <input class="inputLogin" name="name" type="text" placeholder="Username" id="username">
            </div>
            <div class="fieldLogin">
                <label for="email">E-mail</label>
                <input class="inputLogin" name="email" type="text" placeholder="E-mail" id="email">
              </div>
            <div class="fieldLogin">
              <label for="password">Password</label>
              <input class="inputLogin" name="password" type="password" placeholder="Password" id="password">
            </div>
            <div class="fieldLogin">
              <button class="button">Registrarse</button>
            </div>
          </form>
    </div>

<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
          <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
        </a>
        <span class="text-muted">© 2021 Company, Inc</span>
      </div>

      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
      </ul>
    </footer>
  </div>
</div>
</body>
</html>
