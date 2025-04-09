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
    <link rel="stylesheet" href="../css/agregar.css" />
    <title>Agregar evento</title>
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
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="perfil.php">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="logout.php">Cerrar sesión</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="login.php">Iniciar sesión</a>
                        </li>
                    <?php endif; ?>
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
                                        <h4 class="mt-1 mb-5 pb-1">Agregar evento</h4>
                                    </div>
                                    <form action="agregar.php" method="POST">
                                        <h5 class="text-center">Introduce las características del evento</h5>
                                </div>
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="titulo">Título</label>
                                    <input
                                        type="text"
                                        id="titulo"
                                        name="titulo"
                                        class="form-control"
                                        required />
                                </div>
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="fecha">Fecha</label>
                                    <input
                                        type="date"
                                        id="fecha"
                                        name="fecha"
                                        class="form-control"
                                        required />
                                </div>
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="descripcion">Descripción</label>
                                    <textarea class="form-control" name="descripcion" id="descripcion" required>
                                            </textarea>
                                </div>
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="lugar">Lugar</label>
                                    <input
                                        type="text"
                                        id="lugar"
                                        name="lugar"
                                        class="form-control"
                                        required />
                                </div>
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="capacidad">Capacidad</label>
                                    <input
                                        type="number"
                                        id="capacidad"
                                        name="capacidad"
                                        class="form-control"
                                        min="1"
                                        required />
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-center">
                                    <button
                                        type="submit"
                                        data-mdb-button-init
                                        data-mdb-ripple-init
                                        class="btn btn-light">
                                        Agregar propiedad
                                    </button>
                                </div>
                                </form>
                                <?php

                                // establecer la conexión a la db
                                /* require_once __DIR__ . '/../config/conn.php';

                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $tipo_oferta = mysqli_real_escape_string($connection, $_POST['tipo_oferta']);
                                    $calle = mysqli_real_escape_string($connection, $_POST['calle']);
                                    $metros = intval($_POST['metros']);
                                    $imagen = mysqli_real_escape_string($connection, $_POST['imagen']);
                                    $precio = intval($_POST['precio']);
                                    $descripcion = mysqli_real_escape_string($connection, $_POST['descripcion']);

                                    if (!isset($_SESSION['usuario_id'])) {
                                        die("Error: Debes iniciar sesión para agregar propiedades.");
                                    }
                                    $usuario_id = $_SESSION['usuario_id'];

                                    $sql = "INSERT INTO pisos (usuario_id, tipo_oferta, calle,  metros, imagen, precio, descripcion) 
                                        VALUES ( '$usuario_id', '$tipo_oferta', '$calle', '$metros', '$imagen', '$precio', '$descripcion')";
                                    if (mysqli_query($connection, $sql)) {
                                        echo '<h5> Propiedad agregada correctamente </h5>';
                                    } else {
                                        echo '<h5> Ocurrió un error al intentar agregar la propiedad </h5>';
                                    }
                                }
                                mysqli_close($connection);
                                 */ ?>
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