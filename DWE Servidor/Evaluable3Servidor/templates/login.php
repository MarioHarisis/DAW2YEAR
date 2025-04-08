<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../css/login.css" />
  <title>Login</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">
        <i>TecnoEvents</i>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">Iniciar sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="h-100 gradient-form">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 login">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
                  <div class="text-center">
                    <h2>TecnoEvents</h2>
                    <h4 class="mt-1 mb-5 pb-1">Inicio de sesión</h4>
                  </div>

                  <form action="login.php" method="POST">
                    <p>Accede a tu cuenta</p>
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input
                        type="email"
                        id="correo"
                        name="correo"
                        class="form-control"
                        placeholder="Correo electrónico" />
                      <label class="form-label" for="correo">Username</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control" />
                      <label class="form-label" for="password">Contraseña</label>
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                      <button
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-secondary"
                        type="submit">
                        Log in
                      </button>
                      <a class="text-muted" href="cambio_pass.php">¿Olvidaste tu contraseña?</a>
                    </div>

                    <div
                      class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">¿No tienes cuenta?</p>
                      <button
                        type="button"
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-outline-secondary"
                        onclick="window.location.href='crear_cuenta.php';">
                        Crear cuenta
                      </button>
                    </div>
                  </form>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="w-100 h-100">
                  <img
                    src="https://images.unsplash.com/photo-1540317580384-e5d43616b9aa?q=80&w=1587&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Login image"
                    class="img-fluid w-100 h-100"
                    style="object-fit: cover; border-top-right-radius: .3rem; border-bottom-right-radius: .3rem;" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
<?php

require_once "../users.txt";

$file_name = "users.txt";

if (isset($_POST['submit'])) {


  if (file_exists($file_name)) {

    $file = fopen($file_name, "r");
    $users = [];

    while (($linea = fgets($file)) !== false) {

      $data = explode(":", $linea);

      $name = htmlspecialchars($data[0]);
      $password = htmlspecialchars($data[1]);
    }
  }
}

?>