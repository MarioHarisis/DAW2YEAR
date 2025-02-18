<?php
require_once __DIR__ . '/../../config/conn.php';

if (isset($_GET['id'])) {
    $codigo_piso = mysqli_real_escape_string($connection, $_GET['id']);

    $sql = "SELECT * FROM pisos WHERE Codigo_piso = '$codigo_piso'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No se encontró la vivienda";
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
                                        <h4 class="mt-1 pb-1">Editar piso Código: <?php echo $row['Codigo_piso']; ?></h4>
                                        <h4 class="mb-5 pb-1"><?php echo htmlspecialchars($row['calle']); ?></h4>
                                    </div>

                                    <form action="" method="POST">
                                        <input type="hidden" name="codigo_piso" value="<?php echo $row['Codigo_piso']; ?>">

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="titulo">Título</label>
                                            <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo htmlspecialchars($row['titulo']); ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tipo_oferta">¿Venta o alquiler?</label>
                                            <select class="form-select" name="tipo_oferta">
                                                <option value="1" <?php echo ($row['tipo_oferta'] == 1) ? 'selected' : ''; ?>>Venta</option>
                                                <option value="2" <?php echo ($row['tipo_oferta'] == 2) ? 'selected' : ''; ?>>Alquiler</option>
                                            </select>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="calle">Dirección</label>
                                            <input type="text" id="calle" name="calle" class="form-control" value="<?php echo htmlspecialchars($row['calle']); ?>" required>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="metros">Metros(m²)</label>
                                            <input type="number" id="metros" name="metros" class="form-control" min="1" value="<?php echo htmlspecialchars($row['metros']); ?>" required>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="imagen">Imagen</label>
                                            <input type="text" id="imagen" name="imagen" class="form-control" value="<?php echo htmlspecialchars($row['imagen']); ?>" required>
                                            <p>Agrega una imagen (introduce una URL)</p>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="precio">Precio inicial</label>
                                            <input type="number" id="precio" name="precio" class="form-control" min="1" value="<?php echo htmlspecialchars($row['precio']); ?>" required>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="precio">Precio rebajado</label>
                                            <input type="number" id="precio_rebajado" name="precio_rebajado" class="form-control" value="<?php echo htmlspecialchars($row['precio_rebajado']); ?>">
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="descripcion">Descripción</label>
                                            <textarea class="form-control" name="descripcion" id="descripcion" required><?php echo htmlspecialchars($row['descripcion']); ?></textarea>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center">
                                            <button type="submit" class="btn btn-primary">Actualizar Piso</button>
                                            <a href="list_pisos.php" class="btn btn-secondary ms-2">Volver</a>
                                        </div>
                                    </form>

                                </div>
                                <?php
                                // Procesar la actualización del piso
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $codigo_piso = mysqli_real_escape_string($connection, $_POST['codigo_piso']);
                                    $titulo = mysqli_real_escape_string($connection, $_POST['titulo']);
                                    $tipo_oferta = mysqli_real_escape_string($connection, $_POST['tipo_oferta']);
                                    $calle = mysqli_real_escape_string($connection, $_POST['calle']);
                                    $metros = mysqli_real_escape_string($connection, $_POST['metros']);
                                    $imagen = mysqli_real_escape_string($connection, $_POST['imagen']);
                                    $precio = mysqli_real_escape_string($connection, $_POST['precio']);
                                    $descripcion = mysqli_real_escape_string($connection, $_POST['descripcion']);

                                    $sql = "UPDATE pisos SET titulo='$titulo', tipo_oferta='$tipo_oferta', calle='$calle', metros='$metros', imagen='$imagen', precio='$precio', descripcion='$descripcion' WHERE Codigo_piso='$codigo_piso'";

                                    if (mysqli_query($connection, $sql)) {
                                        echo '<h4 class="text-center text-success">Piso actualizado correctamente</h4>';
                                    } else {
                                        echo '<h4 class="text-center text-danger>Error al actualizar el piso: ' . mysqli_error($connection) . '</h4>';
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>