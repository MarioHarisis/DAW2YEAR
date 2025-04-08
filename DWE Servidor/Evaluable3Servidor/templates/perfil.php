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
    <link rel="stylesheet" href="../css/perfil.css" />
    <title>Comprar</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <i class="bi bi-house-fill fs-2">HomeSweetHome</i>
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
                        <a class="nav-link" href="comprar.php">Comprar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="alquilar.php">Alquilar</a>
                    </li>
                    <!-- Si la sesion esta iniciada se muestran los campos NO comunes -->
                    <?php if (isset($_SESSION['usuario_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="perfil.php">Perfil</a>
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

    <div class="container mt-5 d-flex justify-content-center">
        <div class="card card-perfil text-center">
            <!--  Comprobar que tipo de usuario es -->
            <?php if ($_SESSION['tipo_usuario'] == 1): ?>
                <h4>Perfil Vendedor</h4>
            <?php else: ?>
                <h4>Perfil Comprador</h4>
            <?php endif; ?>
            <img src="https://cdn.pixabay.com/photo/2021/07/02/04/48/user-6380868_1280.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php
                                        $correo = $_SESSION['usuario_correo'];
                                        echo htmlspecialchars($correo);
                                        ?></h5>
                <?php if ($_SESSION['tipo_usuario'] == 1): ?>
                    <p class="card-text">Bienvenid@ a tu perfil, aquí podrás agregar tus propiedades.</p>
                    <div class="d-flex gap-1 justify-content-center">
                        <a href="agregar.php"><button class="btn btn-primary">Agregar propiedad</button></a>
                    </div>
                <?php else: ?>
                    <p class="card-text">Bienvenid@ a tu perfil, aquí podrás ver tus propiedades en favoritos.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container-fluid col-12 mt-5">
        <h4>Mis propiedades:</h4>
        <div class="row">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 g-3">
                <?php
                // realizar la conexion
                require_once __DIR__ . '/../config/conn.php';

                // if ordenar, cambiar sentencia sql para ordenar por precio por ejemplo
                $usuario_id = $_SESSION['usuario_id'];
                $sql = "SELECT * FROM pisos WHERE pisos.usuario_id = '$usuario_id' "; // crear sentencia
                $result = mysqli_query($connection, $sql); // hacer consulta

                // si deviuelve más de 0 resultados de filas(row), se ejecuta el while
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { // por cada while se muestra una card de la vivienda
                        echo '<div class="col">';
                        echo '<div class="card">';
                        echo '<img src="' . $row['imagen'] . '" class="card-img-top-vivienda" alt="Imagen de la propiedad">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row['titulo'] . '</h5>';
                        echo '<p class="card-text">' . $row['zona'] . ' ' . $row['metros'] . 'm2' . '</p>';
                        if ($row['precio_rebajado'] > 0) {
                            echo '<h5 class="card-text text-danger">' . 'REBAJADO' . '</h5>';
                            echo '<h5 class="card-text text-danger text-decoration-line-through">' . $row['precio'] . '€' . '</h5>';
                            echo '<h5 class="card-text text-primary">' . 'Precio: ' . $row['precio_rebajado'] . '€' . '</h5>';
                        } else {
                            echo '<h5 class="card-text text-primary">' . 'Precio: ' . $row['precio'] . '€' . '</h5>';
                        }
                        echo '<h5 class="card-text">' . ' Descripcion ' . '</h5>';
                        echo '<p class="card-text">' . $row['descripcion'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // en caso de que no haya datos de viviendas en la db
                    echo "<p class='text-center'>No se encontraron propiedades.</p>";
                }

                mysqli_close($connection);
                ?>
            </div>
        </div>
    </div>
</body>

</html>