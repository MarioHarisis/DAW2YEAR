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
    <link rel="stylesheet" href="/admin/css/style.css" />
    <title>Buscar usuario</title>
</head>

<body>
    <h2>Buscar usuarios</h2>
    <div class="container col-8 mt-5">
        <form action="#" method="POST">
            <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label">Introduce el id del usuario que quieres buscar</label>
                    <input type="text" class="form-control" id="usuario_id" name="usuario_id" required>
                </div>
                <button type="submit" class="btn btn-primary">Buscar usuario</button>
        </form>
        <a href="list_usuarios.php"><button type="button" class="btn btn-secondary">Volver</button></a>
    </div>
    <div class="container col-12 mt-5">
        <table class="table table-bordered">
            <?php
            require_once __DIR__ . '/../../config/conn.php';

            if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['usuario_id'])) {

                $usuario_id = mysqli_real_escape_string($connection, $_POST['usuario_id']);

                $sql = "SELECT * FROM usuario WHERE usuario.usuario_id = '$usuario_id' ";
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tipo usuario</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Edición</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>';
                        echo "<h5> Busqueda realizada: " . $row['nombres'] . "</h5>";
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
                } else {
                    echo " <h5> No se encontraró ningún usuario con ID: " . $usuario_id . "</h5>";
                }
            }
            mysqli_close($connection);
            ?>
            </tbody>
        </table>
    </div>
</body>

</html>