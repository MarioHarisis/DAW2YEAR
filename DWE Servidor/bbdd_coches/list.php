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
  <h4 class="mt-3">Gestor de vehiculos concesionario</h4>
  <div class="container col-12 mt-5">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="add1.php">Añadir coche</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search1.php">Buscar coche</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="delete1.php">Borrar coche</a>
      </li>
    </ul>

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
          die("Conexion fallida: " . mysqli_connect_error());
        }

        $sql = "SELECT id, marca, modelo, año FROM coches ORDER BY marca DESC";
        $result = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<th scope="row">' . $row['id'] . '</th>';
          echo "<td>" . $row['marca'] . "</td>";
          echo "<td>" . $row['modelo'] . "</td>";
          echo "<td>" . $row['año'] . "</td>";
          echo '</tr>';
        }
        mysqli_close($connection);
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>