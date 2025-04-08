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
  <link rel="stylesheet" href="../css/crear_cuenta.css" />
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
          <div class="card rounded-3 crear-cuenta">
            <div class="row g-0">
              <div class="col-12">
                <div class="card-body p-md-5 mx-md-4">
                  <div class="text-center">
                    <h2>TecnoEvents</h2>
                    <h4 class="mt-1 mb-5 pb-1">Crear cuenta nueva</h4>
                  </div>
                  <form action="crear_cuenta.php" method="POST">
                    <h5 class="text-center">Introduce tus datos</h5>
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        required />
                      <label class="form-label" for="name">Username</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        required />
                      <label class="form-label" for="password">Contraseña</label>
                    </div>
                    <div
                      class="d-flex align-items-center justify-content-center pb-4">
                      <button
                        type="submit"
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-secondary">
                        Crear cuenta
                      </button>
                    </div>
                  </form>
                  <?php

                  $file_name = __DIR__ . '/users.txt';

                  if (isset($_POST['submit'])) {
                    $input_name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
                    $input_password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');

                    if (file_exists($file_name)) {
                      $file = fopen($file_name, "a");
                      while (($linea = fgets($file) !== false)) {
                        $data = explode(":", trim($linea));
                      }
                    }
                  }

                  ?>
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