<?php
// establecer conexion con BBDD
$connection = mysqli_connect('localhost', 'root', '', 'concesionario');

if (!$connection) {
    // en caso de que no establezca conexión se termina la ejecución inmediatamente con die
    // no se ejecutaría más codigo después de esto
    die("Conexion fallida: " . mysqli_connect_error());
}

//oobtención de marca y modelo desde el form
$marca = mysqli_real_escape_string($connection, $_POST['marca']);
$modelo = mysqli_real_escape_string($connection, $_POST['modelo']);
$year = mysqli_real_escape_string($connection, $_POST['year']);

// query de insertación
$sql = "INSERT INTO coches (marca, modelo, año) VALUES ( '$marca' , '$modelo', '$year' )";

if (mysqli_query($connection, $sql)) {
    echo "Vehiculo añadido correctamente";
    echo "<button class='btn btn-secondary'><a href='list.php'>Volver a inicio</a></button>";
} else {
    echo "Error";
}

mysqli_close($connection);
