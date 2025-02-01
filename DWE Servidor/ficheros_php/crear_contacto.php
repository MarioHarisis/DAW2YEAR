<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Crear contacto</title>
  <style>
    form {
      display: flex;
      flex-direction: column;
      max-width: 300px;
      margin: 0 auto;
    }

    label,
    input {
      margin-bottom: 10px;
      font-size: 16px;
    }

    input {
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"]:hover {
      cursor: pointer;
    }
  </style>
</head>

<body>
  <form action="" method="POST">
    <label for="nombre">Nombre completo:</label>
    <input type="text" id="nombre" name="nombre" required />

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" />

    <label for="correo">Correo:</label>
    <input type="text" id="correo" name="correo" />

    <input type="submit" value="Crear contacto" name="submit">

  </form>
  <a href="index.html">Volver</a><br>
</body>

</html>

<?php
require_once "Contacto.php";

$file_name = "contactos.txt";

if (isset($_POST['submit'])) {
  $nombre = htmlspecialchars($_POST['nombre']);
  $telefono = htmlspecialchars(trim($_POST['telefono']));
  $correo = htmlspecialchars(trim($_POST['correo']));

  // Validación de datos básicos
  if (empty($nombre)) {
    echo "Por favor, completa todos los campos obligatorios.";
    exit;
  }

  if (empty($telefono)) {
    $telefono = "Sin datos";
  }

  if (empty($correo)) {
    $correo = "Sin datos";
  }

  $contenido = $nombre . ',' . $telefono . ',' . $correo . "\n";

  if (file_exists($file_name)) {
    $contactos = [];
    if (array_push($contactos, new Contacto($nombre, $telefono, $correo))) {
      echo "<h4>" . $nombre . " agregado correctamente a la lista de contactos </h4>";
      echo "<a href='mostrar.php'>Ver lista de contactos</a>";
    }

    $file = fopen($file_name, "a");
    fwrite($file, $contenido);
    fclose($file);
  } else {
    echo "No se ha podido encontrar el archivo";
  }
} else {
  echo "Envía el formulario para agregar un contacto";
}
?>