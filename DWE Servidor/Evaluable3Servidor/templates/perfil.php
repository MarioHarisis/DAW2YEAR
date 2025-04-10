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
    <h2 class="text-center">Administración de los eventos</h2>
    <div class="container list-container mt-5">
        <a href="agregar.php"><button class="btn btn-secondary">Agregar un evento nuevo</button></a>
        <div class="list-group mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Lugar</th>
                        <th scope="col">Capacidad</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    require_once __DIR__ . '/../config/conn.php';

                    $sql = "SELECT * FROM eventos";
                    $result = mysqli_query($connection, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<th scope="row">' . $row['id'] . '</th>';
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['fecha'] . "</td>";
                        echo "<td>" . $row['descripcion'] . "</td>";
                        echo "<td>" . $row['lugar'] . "</td>";
                        echo "<td>" . $row['capacidad'] . "</td>";
                        // Dentro del bucle que genera las filas de la tabla:
                        echo "
                        <td>
                            <a href='agregar.php?id=" . $row['id'] . "' class='btn btn-warning'>Editar</a>
                        </td>";

                        // Aquí agregamos un form para poder eliminar
                        echo "<td>
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='eliminar_id' value='" . $row['id'] . "'>
                                    <button type='submit' name='btn_eliminar' class='btn btn-danger'>Eliminar</button>
                                </form>
                            </td>";

                        echo '</tr>';
                    }

                    // funcionalidad del botón eliminar
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_eliminar'])) {
                        $eventoId = filter_input(INPUT_POST, 'eliminar_id', FILTER_VALIDATE_INT);

                        if ($eventoId) {
                            $stmt = $connection->prepare("DELETE FROM eventos WHERE id = ?");
                            $stmt->bind_param("i", $eventoId);

                            if ($stmt->execute()) {
                                //recargo la página haciendo un redireccionamiento, para que se reflejen los cambios
                                echo '<script type="text/javascript">
                                        window.location.href = "perfil.php";
                                    </script>';
                            } else {
                                echo "<p class='text-danger'>Error al eliminar el evento.</p>";
                            }
                            $stmt->close();
                        } else {
                            echo "<p class='text-warning'>ID no válido.</p>";
                        }
                    }
                    mysqli_close($connection);
                    ?>
                </tbody>
            </table>
        </div>
</body>

</html>