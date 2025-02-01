<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buscar contacto</title>
</head>

<body>
  <form action="" method="POST">
    <label> Introduce nombre del contacto que deseas buscar: </label>
    <input type="text" name="busqueda" />
    <input type="submit" value="Buscar" name="submit">
  </form>
</body>

</html>

<?php
// Importar la clase Contacto
require_once "Contacto.php";

$file_name = "contactos.txt";

if (isset($_POST['submit'])) {
  $busqueda = strtolower($_REQUEST["busqueda"]);

  if (file_exists($file_name)) {
    $file = fopen($file_name, "r");

    $contactos = [];
    while (($linea = fgets($file)) !== false) {
      // leer fichero y dividir en las comas
      $datos = explode(",", $linea);

      // asignar datos a variables, 
      //podríamos meterlas al constructor directamente pero así queda más claro
      $nombre = htmlspecialchars($datos[0]);
      $telefono = trim($datos[1]);
      $correo = htmlspecialchars($datos[2]);

      // Creación del contacto que se sobreescribe según se vayan leyendo las líneas
      $contactos[] = new Contacto($nombre, $telefono, $correo);
    }
    fclose($file);

    echo "<ul>";

    $encontrado = false;
    echo "<h4> Resultados con ' " . $busqueda . " ': </h4>";
    foreach ($contactos as $contacto) {
      // str_contains nos devuelve booleano si encuentra coincidencias en el string
      if (str_contains(strtolower($contacto->getNombre()), $busqueda)) {
        $encontrado = true;
        echo "<li>" . $contacto->mostrarContacto() . "</li>";
      }
    }
    echo "</ul>";

    if (!$encontrado) {
      echo "<h4> No se encontraron resultados de: " . $busqueda . "</h4>";
    }
    echo '<a href="index.html">Volver</a>';
  } else {
    echo "No se pudo encontrar el archivo";
  }
} else {
  echo "<h2>Envía el formulario para buscar un contacto.</h2>";
}

?>