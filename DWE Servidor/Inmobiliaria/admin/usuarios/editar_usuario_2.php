<?php
require_once __DIR__ . '/../../config/conn.php';

if (isset($_GET['id'])) {
    $usuario_id = mysqli_real_escape_string($connection, $_GET['id']);

    $sql = "SELECT * FROM usuario WHERE usuario_id = '$usuario_id'";
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
    <link rel="stylesheet" href="css/login.css" />
    <title>Editar usuario</title>
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
                                        <h4 class="mt-1 mb-5 pb-1">Editar usuario ID: <?php echo $row['usuario_id']; ?></h4>
                                    </div>
                                    <form action="#" method="POST">
                                        <div class="form-outline mb-4">
                                            <input type="hidden" name="usuario_id" value="<?php echo $row['usuario_id']; ?>">
                                        </div>
                                        <div class="form-outline mb-4">
                                            <p>¿Vendedor o comprador?</p>
                                            <select
                                                class="form-select mb-4"
                                                aria-label="Default select example"
                                                name="tipo_usuario">
                                                <option selected hidden
                                                    value="0">
                                                    Selecciona una opción
                                                </option>
                                                <?php if ($row['tipo_usuario'] == 1): ?>
                                                    <option value="1" selected>Vendedor</option>
                                                    <option value="2">Comprador</option>
                                                <?php else: ?>
                                                    <option value="1">Vendedor</option>
                                                    <option value="2" selected>Comprador</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="usuario_id" name="usuario_id" class="form-control" readonly value="<?php echo htmlspecialchars($row['usuario_id']); ?>" required>
                                            <label class="form-label" for="usuario_id">Usuario ID</label>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo htmlspecialchars($row['nombres']); ?>" required>
                                            <label class="form-label" for="nombres">Nombre completo</label>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="email" id="correo" name="correo" class="form-control" value="<?php echo htmlspecialchars($row['correo']); ?>" required>
                                            <label class="form-label" for="correo">Correo</label>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
                                        <a href="list_usuarios.php"><button type="button" class="btn btn-secondary">Volver</button></a>
                                    </form>
                                    <?php
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        $usuario_id = mysqli_real_escape_string($connection, $_POST['usuario_id']);
                                        $nombres = mysqli_real_escape_string($connection, $_POST['nombres']);
                                        $correo = mysqli_real_escape_string($connection, $_POST['correo']);
                                        $tipo_usuario = mysqli_real_escape_string($connection, $_POST['tipo_usuario']);

                                        $sql = "UPDATE usuario SET nombres='$nombres', correo='$correo', tipo_usuario='$tipo_usuario' WHERE usuario_id='$usuario_id'";

                                        if (mysqli_query($connection, $sql)) {
                                            echo '<h4>Usuario editado correctamente</h4>';
                                        } else {
                                            echo '<h4>Error al editar usuario: ' . mysqli_error($connection) . '</h4>';
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