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
    <title>Concesionario</title>
</head>

<body>
    <h4 class="mt-3">Buscador de vehículos</h4>
    <div class="container col-12 mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Año</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $connection = mysqli_connect('localhost', 'root', '', 'concesionario');

                if (!$connection) {
                    die("Error de conexión:" . mysqli_connect_error());
                }

                $marca_buscar = mysqli_real_escape_string($connection, $_POST['marca']);

                $sql = "SELECT * FROM coches WHERE marca = '$marca_buscar' ";
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<h5> Busqueda realizada: " . $marca_buscar . "</h5>";
                        echo '<tr>';
                        echo '<th scope="row">' . $row['id'] . '</th>';
                        echo "<td>" . $row['marca'] . "</td>";
                        echo "<td>" . $row['modelo'] . "</td>";
                        echo "<td>" . $row['año'] . "</td>";
                        echo '</tr>';
                    }
                } else {
                    echo " <h5> No se encontraron vehículos con la marca: " . $marca_buscar . "</h5>";
                }
                mysqli_close($connection);
                ?>
            </tbody>
        </table>
        <button class="btn btn-secondary"><a class="nav-link" href="list.php">Volver a inicio</a></button>
    </div>
</body>

</html>