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
        <i class="bi fs-2">TecnoEvents</i>
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
            <a class="nav-link active" aria-current="page" href="login.php">
              <h5>Iniciar sesión</h5>
            </a>
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
                        type="text"
                        name="name"
                        class="form-control" />
                      <label class="form-label" for="name">Username</label>
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
                        type="submit"
                        name="submit">
                        Log in
                      </button>
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
                <?php

                // llamar al archivo txt
                $file_name = __DIR__ . '/../users.txt';
                $valid_user = false;

                // debe existir un button type= submit y con name=submit
                if (isset($_POST['submit'])) {

                  // obtener name y password del formulario
                  $input_name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
                  $input_password = ($_POST['password']);


                  // comprobar que los campos no están vacíos
                  if (empty(trim($input_name)) || empty(trim($input_password))) {
                    echo '
                    <div class="container">
                      <div class="alert alert-danger text-center" role="alert">
                        Nombre o contraseña vacío
                      </div>
                    </div>';
                  } else {

                    // comprobar que el archivo existe
                    if (file_exists($file_name)) {

                      // asignar archivo abierto
                      $file = fopen($file_name, "r");

                      // fgets($file) lee una línea del archivo y la devuelve como una cadena de texto.
                      // fgets() devuelve false cuando llega al final del archivo (EOF, "End Of File").
                      while (($linea = fgets($file)) !== false) {
                        $data = explode(":", trim($linea)); // explode devuelve $data = ["usuario", "1234"];

                        // comprobar que existen ambos campos es decir que $data es >= 2
                        if (count($data) >= 2) {
                          // htmlspecialchars para protegernos de inyecciones maliciosas
                          $name = htmlspecialchars(trim($data[0]));
                          $hash_password = trim($data[1]);

                          // nombre y contraseña coninciden con los del txt
                          if ($name === $input_name && password_verify($input_password, $hash_password)) {
                            $valid_user = true;
                            echo '
                    <div class="container">
                      <div class="alert alert-primary text-center" role="alert">
                        User válido
                      </div>
                    </div>';
                            break;
                          }
                        }
                      }
                      // cerrar archivo
                      fclose($file);

                      if ($valid_user) {
                        // asignar el nombre de usuario a la sesión
                        $_SESSION['user'] = $input_name;

                        //redireccionar al home
                        echo '<script type="text/javascript">
                                window.location.href = "home.php";
                              </script>';
                        exit();
                      } else { // usuario o conraseña incorrectos
                        echo '
                        <div class="container">
                          <div class="alert alert-danger text-center" role="alert">
                            Nombre o contraseña incorrecto
                          </div>
                        </div>';
                      }
                    }
                  }
                }
                ?>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="w-100 h-100">
                  <img
                    src="https://images.unsplash.com/photo-1564522365984-c08ed1f78893?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
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