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
    <section class="h-100 gradient-form" style="background-color: #eee">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 crear-cuenta">
                        <div class="row g-0">
                            <div class="col-12">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <h2>Admin</h2>
                                        <h4 class="mt-1 mb-5 pb-1">Dar de alta usuario</h4>
                                    </div>
                                    <form action="#" method="POST">
                                        <h5 class="text-center">Datos del usuario</h5>
                                        <p>¿Vendedor o comprador?</p>
                                        <select
                                            class="form-select mb-4"
                                            aria-label="Default select example"
                                            name="tipo_usuario">
                                            <option selected hidden
                                                value="0">
                                                Selecciona una opción
                                            </option>
                                            <option value="1">Vendedor</option>
                                            <option value="2">Comprador</option>
                                        </select>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input
                                                type="text"
                                                id="nombres"
                                                name="nombres"
                                                class="form-control"
                                                required />
                                            <label class="form-label" for="nombres">Nombre completo</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input
                                                type="email"
                                                id="correo"
                                                name="correo"
                                                class="form-control"
                                                placeholder="Correo electrónico"
                                                required />
                                            <label class="form-label" for="correo">Username</label>
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
                                                class="btn btn-primary">
                                                Crear cuenta
                                            </button>
                                            <a href="list_usuarios.php"><button type="button" class="btn btn-secondary">Volver</button></a>
                                        </div>
                                    </form>
                                    <?php

                                    // establecer la conexión a la db
                                    require_once __DIR__ . '/../../config/conn.php';


                                    // Verificar si se ha enviado el formulario
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                        $nombres = mysqli_real_escape_string($connection, $_POST['nombres']);
                                        $correo = mysqli_real_escape_string($connection, $_POST['correo']);
                                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Cifrar la contraseña
                                        $tipo_usuario = mysqli_real_escape_string($connection, $_POST['tipo_usuario']);

                                        // comprobar si se ingresó el tipo de usuario
                                        if ($tipo_usuario == 0) {
                                            echo '
                          <p class="text-center">
                          Selecciona un tipo de usuario
                          </p>';
                                            exit;
                                        }

                                        $sql_correo = "SELECT correo From usuario WHERE usuario.correo = '$correo' ";
                                        $result = mysqli_query($connection, $sql_correo);

                                        // comprobar si el correo ya existe
                                        if (mysqli_num_rows($result) == 0) {

                                            $sql = "INSERT INTO usuario ( nombres , correo, clave, tipo_usuario ) 
                          VALUES ('$nombres' , '$correo' , '$password' , '$tipo_usuario' ) ";

                                            // insertar usuario creado en la db
                                            if (mysqli_query($connection, $sql)) {
                                                echo "Usuario $nombres añadido correctamente";
                                            } else {
                                                echo "Error al registar usuario: " . mysqli_errno($connection);
                                            }
                                        } else {
                                            echo '
                          <p class="text-center">
                          Este correo ya existe
                          </p>';
                                        }
                                    }
                                    mysqli_close($connection);
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