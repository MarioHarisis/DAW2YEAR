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
    <link rel="stylesheet" href="../css/perfil.css">
    <title>Mis propiedades</title>
</head>

<body>
    <nav class=" navbar navbar-expand-lg">
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
                    <!-- Si la sesion esta iniciada se muestran los campos NO comunes -->
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="perfil.php">Mis propiedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="logout.php">Cerrar sesión</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="login.php">Iniciar sesión</a>
                        </li>
                    <?php
                    } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container list-container mt-5">
        <h4 class="text-center">Mis propiedades:</h4>
        <div class="list-group">
            <?php

            /*             require_once __DIR__ . '/../config/conn.php';


            $sql = "INSERT INTO eventos (id, nombre, fecha,  descripcion, lugar, capacidad) 
                                        VALUES ( '$usuario_id', '$tipo_oferta', '$calle', '$metros', '$imagen', '$precio', '$descripcion')";

            for ($i = 0; $i <= 10; $i++) {
                echo '<button type="button" class="list-group-item list-group-item-action">A second button item</button>';
            } */
            ?>
        </div>
</body>

</html>