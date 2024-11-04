<?php
echo "<h1> Ejercicio 5 </h1>"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>Número inicial</th>
                <th>Número al Cuadrado</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i < 10; $i++) { ?>
                <tr>
                    <td><?php echo $aleatorio = rand(5, 20); ?></td>
                    <td><?php echo $aleatorio * $aleatorio; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>


</html>