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
    <h2>Buscar vivienda</h2>
    <div class="container col-8 mt-5">
        <form action="#" method="POST">
            <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label">Introduce el código de la vivienda que quieres buscar</label>
                    <input type="text" class="form-control" id="codigo_piso" name="codigo_piso" required>
                </div>
                <button type="submit" class="btn btn-primary">Buscar vivienda</button>
        </form>
        <a href="list_pisos.php"><button type="button" class="btn btn-secondary">Volver</button></a>
    </div>
    <div class="container col-12 mt-5">
        <table class="table table-bordered">
            <?php
            require_once __DIR__ . '/../../config/conn.php';

            if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['codigo_piso'])) {

                $codigo_piso = mysqli_real_escape_string($connection, $_POST['codigo_piso']);

                $sql = "SELECT * FROM pisos WHERE pisos.Codigo_piso = $codigo_piso";
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tipo de oferta</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Calle</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Precio rebajado</th>
                        <th scope="col">Edicion</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>';
                        echo '<tr>';
                        echo '<th scope="row">' . $row['Codigo_piso'] . '</th>';
                        if ($row['tipo_oferta']  == 1) {
                            echo '<td>Venta</td>';
                        } else {
                            echo '<td>Alquiler</td>';
                        }
                        echo "<td>" . $row['titulo'] . "</td>";
                        echo "<td>" . $row['calle'] . "</td>";
                        echo "<td>" . $row['precio'] . "</td>";
                        echo '<td>' . $row['precio_rebajado'] . '</td>';
                        echo "<td><a href='editar_piso_2.php?id=" . $row['Codigo_piso'] . "'>
                    <button type='button' class='btn btn-secondary'>Editar</button>
                    </a></td>";
                        echo "<td><a href='baja_piso.php?id=" . $row['Codigo_piso'] . "'>
                    <button type='button' class='btn btn-danger'>Eliminar</button>
                    </a></td>";
                        echo '</tr>';
                    }
                } else {
                    echo " <h5> No se encontraró ninguna vivienda con código: " . $codigo_piso . "</h5>";
                }
            }
            mysqli_close($connection);
            ?>
            </tbody>
        </table>
    </div>
</body>

</html>