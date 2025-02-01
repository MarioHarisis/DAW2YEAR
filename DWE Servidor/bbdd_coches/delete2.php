<?php
$connection = mysqli_connect('localhost', 'root', '', 'concesionario');

if (!$connection) {
    die("Error al intentar conectar" . mysqli_connect_error());
}

$id_eliminar = mysqli_real_escape_string($connection, $_POST['id']);

// consulta de selección
$sql = "SELECT * FROM coches WHERE id = '$id_eliminar' ";
$result = mysqli_query($connection, $sql);

// comprobar primero si existe el vehiculo con ese id
if (mysqli_num_rows($result) > 0) {

    $sql = "DELETE FROM coches WHERE id = '$id_eliminar'";

    if (mysqli_query($connection, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Vehículo: " . $row['marca'] . " " . $row['modelo'] .  " eliminado correctamente<br>";
        }
    }
} else {
    echo "<h3> No se encontró vehículo con ID: " . $id_eliminar . "</h3>";
}
mysqli_close($connection);
echo "<button><a href='list.php'>Volver a inicio</a></button><br>";
echo "<button><a href='delete1.php'>Introducir otro ID</a></button>";
