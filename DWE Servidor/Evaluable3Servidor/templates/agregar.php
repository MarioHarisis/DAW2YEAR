<?php
session_start();

require_once __DIR__ . '/../config/conn.php';

// Verificar si existe el parámetro 'id' en la URL (para actualizar un evento)
if (isset($_GET['id'])) {
    $eventoId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $_SESSION['eventoId'] = $eventoId;

    if ($eventoId) {

        // buscar el evento con ese id en la DB
        $stmt = $connection->prepare("SELECT * FROM eventos WHERE id = ? ");

        $stmt->bind_param("i", $eventoId); // asignamos a la ? el valor de $eventoId recogido en la url

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // si encuentra resultados
            if ($result->num_rows > 0) {
                // obtener los resultados
                $evento = $result->fetch_assoc();

                // rellenar los valores para el formulario
                $nombre = $evento['nombre'];
                $fecha = $evento['fecha'];
                $descripcion = $evento['descripcion'];
                $lugar = $evento['lugar'];
                $capacidad = $evento['capacidad'];
            } else {
                echo "Evento no encontrado.";
            }
        } else {
            echo "Error al obtener los datos del evento.";
        }
        $stmt->close();
    }
}
?>
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
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../css/agregar.css" />
    <title>Agregar evento</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <i class="bi fs-2">TecnoEvents</i>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="perfil.php">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="logout.php">Cerrar sesión</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="login.php">Iniciar sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 crear-cuenta">
                        <div class="row g-0">
                            <div class="col-12">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <h2>TecnoEvents</h2>
                                        <h4 class="mt-1 mb-5 pb-1">Agregar evento</h4>
                                    </div>
                                    <form action="agregar.php" method="POST">
                                        <h5 class="text-center">Introduce las características del evento</h5>

                                        <div data-mdb-input-init class="form-outline mb-3">
                                            <label class="form-label" for="nombre">Nombre del evento</label>
                                            <input
                                                type="text"
                                                id="nombre"
                                                name="nombre"
                                                class="form-control"
                                                value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>"
                                                required />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-3">
                                            <label class="form-label" for="fecha">Fecha</label>
                                            <input
                                                type="date"
                                                id="fecha"
                                                name="fecha"
                                                class="form-control"
                                                value="<?php echo isset($fecha) ? htmlspecialchars($fecha) : ''; ?>"
                                                required />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-3">
                                            <label class="form-label" for="descripcion">Descripción</label>
                                            <textarea class="form-control" name="descripcion" id="descripcion" required><?php echo isset($descripcion) ? htmlspecialchars($descripcion) : ''; ?></textarea>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-3">
                                            <label class="form-label" for="lugar">Lugar</label>
                                            <input
                                                type="text"
                                                id="lugar"
                                                name="lugar"
                                                class="form-control"
                                                value="<?php echo isset($lugar) ? htmlspecialchars($lugar) : ''; ?>"
                                                required />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-3">
                                            <label class="form-label" for="capacidad">Capacidad</label>
                                            <input
                                                type="number"
                                                id="capacidad"
                                                name="capacidad"
                                                class="form-control"
                                                value="<?php echo isset($capacidad) ? htmlspecialchars($capacidad) : ''; ?>"
                                                min="1"
                                                required />
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center">
                                            <button type="submit" name="submit" class="btn btn-secondary">
                                                <?php echo isset($eventoId) && $eventoId ? 'Actualizar evento' : 'Crear evento'; ?>
                                            </button>
                                        </div>
                                    </form>
                                    <?php

                                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

                                        $eventoId = isset($_SESSION['eventoId']) ? $_SESSION['eventoId'] : null;

                                        // Validación de los inputs
                                        $nombre = trim(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                                        $fecha = $_POST['fecha'];
                                        $descripcion = trim(filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                                        $lugar = trim(filter_input(INPUT_POST, 'lugar', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                                        $capacidad = filter_input(INPUT_POST, 'capacidad', FILTER_VALIDATE_INT);

                                        if ($eventoId) {
                                            // Actualización de evento existente
                                            $sql = "UPDATE eventos SET nombre = ?, fecha = ?, descripcion = ?, lugar = ?, capacidad = ? WHERE id = ?";
                                            $stmt = $connection->prepare($sql);

                                            if ($stmt) {
                                                $stmt->bind_param("ssssii", $nombre, $fecha, $descripcion, $lugar, $capacidad, $eventoId);

                                                if ($stmt->execute()) {
                                                    echo '
                                                    <div class="container mt-2">
                                                    <div class="alert alert-success text-center" role="alert">
                                                        Evento actualizado correctamente
                                                    </div>
                                                    </div>';
                                                    echo '<script type="text/javascript">
                                                        window.location.href = "perfil.php";
                                                        </script>';
                                                } else {
                                                    echo '
                                                    <div class="container mt-2">
                                                    <div class="alert alert-danger text-center" role="alert">
                                                        Algo salió mal
                                                    </div>
                                                    </div>';
                                                }
                                                $stmt->close();
                                            } else {
                                                echo '<h5>Error al preparar la consulta.</h5>';
                                            }
                                        } else {
                                            /* Crear un evento nuevo */

                                            // preparar consulta
                                            $sql = "INSERT INTO eventos (nombre, fecha, descripcion, lugar, capacidad) VALUES (?, ?, ?, ?, ?)";
                                            $stmt = $connection->prepare($sql);

                                            if ($stmt) {
                                                // rellenar consulta
                                                $stmt->bind_param("ssssi", $nombre, $fecha, $descripcion, $lugar, $capacidad);

                                                // ejecutar consulta
                                                if ($stmt->execute()) {
                                                    echo '
                                                    <div class="container mt-2">
                                                    <div class="alert alert-success text-center" role="alert">
                                                        Evento creado correctamente
                                                    </div>
                                                    </div>';
                                                } else {
                                                    echo '
                                                    <div class="container mt-2">
                                                    <div class="alert alert-danger text-center" role="alert">
                                                        Algo salió mal
                                                    </div>
                                                    </div>';
                                                }
                                                $stmt->close();
                                            } else {
                                                echo '<h5>Error al preparar la consulta.';
                                            }
                                        }
                                    }
                                    mysqli_close($connection);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>