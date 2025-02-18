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
        <h2 class="text-center">Lista de viviendas</h2>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="alta_piso.php">Alta de vivienda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="buscar_piso.php">Baja de vivienda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-warning" href="buscar_piso.php">Buscar vivienda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary" href="buscar_piso.php">Editar vivienda</a>
            </li>
        </ul>

        <table class="table table-bordered">
            <?php

            require_once __DIR__ . '/../../config/conn.php';

            $sql = "SELECT * FROM pisos";
            $result = mysqli_query($connection, $sql);

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

            while ($row = mysqli_fetch_assoc($result)) {
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
            mysqli_close($connection);
            ?>
            </tbody>
        </table>
        <a href="../index.php"><button type="button" class="btn btn-secondary">Volver</button></a>
    </div>
</body>

</html>