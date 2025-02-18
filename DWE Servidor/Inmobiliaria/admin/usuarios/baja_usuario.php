<?php
require_once __DIR__ . '/../../config/conn.php';

if (isset($_GET['id'])) {
    $usuario_id = mysqli_real_escape_string($connection, $_GET['id']);

    $sql = "SELECT * FROM usuario WHERE usuario.usuario_id = '$usuario_id'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No se encontró el usuario";
        exit;
    }
} else {
    echo "ID no especificado";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Piso</title>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3">
                        <div class="row g-0">
                            <div class="col-12">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <h2>Admin</h2>
                                        <h4 class="mt-1 pb-1">¿Seguro que quieres eliminar el usuario con ID: <?php echo $row['usuario_id']; ?> ?</h4>
                                        <h4 class="mb-5 pb-1"><?php echo htmlspecialchars($row['correo']); ?></h4>
                                    </div>
                                    <form action="#" method="POST">
                                        <table class="table table-bordered">
                                            <?php

                                            require_once __DIR__ . '/../../config/conn.php';

                                            $sql = "SELECT * FROM usuario WHERE usuario.usuario_id = '$usuario_id'";
                                            $result = mysqli_query($connection, $sql);

                                            echo '<thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tipo de usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Edicion</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>';
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
                                                echo "<td>
                                                <button type='submit' class='btn btn-danger'>Eliminar definitivamente</button>
                                                </a></td>";
                                                echo '</tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <a href="list_usuarios.php"><button type="button" class="btn btn-secondary">Volver</button></a>
                                    </form>
                                </div>
                                <?php
                                // Procesar la actualización del piso
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                    $sql = "DELETE FROM usuario WHERE usuario.usuario_id = '$usuario_id'";

                                    if (mysqli_query($connection, $sql)) {
                                        echo '<h4 class="text-center text-success">Usuario eliminado correctamente</h4>';
                                    } else {
                                        echo '<h4 class="text-center text-danger>Error al eliminar usuario: ' . mysqli_error($connection) . '</h4>';
                                    }
                                }
                                mysqli_close($connection)
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>