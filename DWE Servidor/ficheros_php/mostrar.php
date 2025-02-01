<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Todos los contactos</title>
</head>

<body>
  <div>
    <h2>Todos los contactos</h2>
  </div>
  <?php

  // importar clase de contacto 
  require_once "contacto.php";

  $file_name = "contactos.txt";

  if (file_exists($file_name)) {
    $file = fopen($file_name, "r");

    echo '<ul>';

    while (($linea = fgets($file)) !== false) {
      // leer fichero y dividir en las comas
      $contactos = explode(",", $linea);

      // asignar datos a variables, 
      //podríamos meterlas al constructor directamente pero así queda más claro
      $nombre = htmlspecialchars($contactos[0]);
      $telefono = htmlspecialchars($contactos[1]);
      $correo = htmlspecialchars($contactos[2]);

      // Creación del contacto que se sobreescribe según se vayan leyendo las líneas
      $contacto = new Contacto($nombre, $telefono, $correo);
      array_push($contactos, $contacto);

      echo '<li>' . $contacto->mostrarContacto() . '</li><br>';
    }
    echo '</ul>';
  }

  ?>
  <a href="index.html">Volver</a>
</body>

</html>