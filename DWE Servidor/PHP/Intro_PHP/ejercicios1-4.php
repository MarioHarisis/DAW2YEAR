<?php

// Ejercicio 1
$numero = 0;

echo "<p> Ejercicio 1 </p>";
while ($numero <= 100) {
    if ($numero % 5 == 0) {
        echo $numero . " ";
    }
    $numero++;
}
echo "<br>";


// Ejercicio 2
echo "<p> Ejercicio 2 </p>";
for ($i = 320; $i > 160; $i -= 20) {
    echo $i . " ";
}
?>

<!--  Ejercicio 3 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios 1-4</title>
</head>

<body>
    <h1>Tabla de multiplicar del <?php $aleatorio = rand(1, 10);
                                    echo $aleatorio ?></h1>
    <table>
        <?php
        for ($i = 1; $i < 10; $i++) {
            $multiplicacion = $aleatorio * $i;
        ?>
            <ul>
                <li>
                    <?php echo $multiplicacion; ?>
                </li>
            </ul>
        <?php
        }
        ?>
    </table>

</body>

</html>

<?php
$aleatorio = rand(1, 10);
echo " <h2> Tabla de multiplicar del " . $aleatorio . " (segundo método) </h2>";

// otra forma de hacer el ejercicio 3
echo "<table>";
for ($i = 1; $i < 10; $i++) {
    $multiplicacion = $aleatorio * $i;
    echo "<ul>";
    echo "<li>";
    echo $multiplicacion . " ";
    echo "</li>";
    echo "</ul>";
}
echo "</table>";


// Ejercicio 4
echo "<p> Ejercicio 4 </p>";
$aleatorio = rand(0, 9999);
echo "Número aleatorio:" . $aleatorio;

$cantDigitos = strlen((string)$aleatorio);
echo "<br>";
echo "Numero de digitos: " . $cantDigitos;
?>