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
    <link rel="stylesheet" href="style.css" />
    <title>Buscar vehiculo concesionario</title>
</head>

<body>
    <h2>Buscar vehículos</h2>
    <div class="container col-8 mt-5">
        <form action="search2.php" method="POST">
            <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label">Introduce marca del vehículo que quieres buscar</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                </div>
                <button type="submit" class="btn btn-primary">Buscar vehiculo</button>
        </form>
        <button class="btn btn-secondary"><a href="list.php">Volver a inicio</a></button>
    </div>
</body>

</html>