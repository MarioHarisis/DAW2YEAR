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
    <link rel="stylesheet" href="style_list.css" />
    <title>Admin</title>
</head>

<body>
    <h4 class="mt-3">Admin</h4>
    <div class="container col-12 mt-5">
        <h2 class="text-center">Lista de usuarios</h2>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="alta_usuario.php">Alta de usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="buscar_usuario.php">Baja de usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-warning" href="buscar_usuario.php">Buscar usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary" href="buscar_usuario.php">Editar usuario</a>
            </li>
        </ul>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tipo usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Edición</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php

                require_once __DIR__ . '/../../config/conn.php';

                $sql = "SELECT * FROM usuario";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<th scope="row">' . $row['usuario_id'] . '</th>';
                    if ($row['tipo_usuario'] == 1) {
                        echo "<td>Comprador</td>";
                    } else {
                        echo "<td>Vendedor</td>";
                    }
                    echo "<td>" . $row['nombres'] . "</td>";
                    echo "<td>" . $row['correo'] . "</td>";
                    echo "<td><a href='editar_usuario_2.php?id=" . $row['usuario_id'] . "'>
                    <button type='button' class='btn btn-secondary'>Editar</button>
                    </a></td>";
                    echo "<td><a href='baja_usuario.php?id=" . $row['usuario_id'] . "'>
                    <button type='button' class='btn btn-danger'>Eliminar</button>
                    </a></td>";
                    echo '</tr>';
                }
                mysqli_close($connection);
                ?>
            </tbody>
        </table>
        <a href="../index.php"><button type="button" class="btn btn-secondary">Volver</button></a>
    </div>
</body>

</html>