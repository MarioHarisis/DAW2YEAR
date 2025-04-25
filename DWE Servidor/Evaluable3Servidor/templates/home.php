<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
    crossorigin="anonymous" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/home.css" />
  <title>Evaluable 3</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid justify-content-between">

      <!-- Botón para vista móvil -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="home.php">
              <h5>Home</h5>
            </a>
          </li>
          <?php if (isset($_SESSION['user'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="perfil.php">Gestionar eventos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Cerrar sesión</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Iniciar sesión</a>
            </li>
          <?php } ?>
        </ul>
      </div>

    </div>
  </nav>
  <main>
    <div class="row">
      <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"></button>
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="https://images.unsplash.com/photo-1560523160-754a9e25c68f?q=80&w=1436&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block w-100"
              alt="..." />
          </div>
          <div class="carousel-item">
            <img
              src="https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block w-100"
              alt="..." />
          </div>
          <div class="carousel-item">
            <img
              src="https://images.unsplash.com/photo-1558008258-3256797b43f3?q=80&w=1331&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block w-100"
              alt="..." />
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <!-- Images container -->
    <div class="container home-container">
      <hr class="divider my-4" />
      <div class="row mt-2">
        <div class="col-md-7 order-md-2">
          <h2 class="heading">
            Oh yeah, it's that good. <span class="text-secondary">See for yourself.</span>
          </h2>
          <p class="lead">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in purus id
            nibh dapibus dictum. Suspendisse vitae diam risus. Nam sagittis ultrices
            ipsum quis aliquet. Praesent aliquet ornare ante, eget cursus metus maximus
            nec. In quis dolor ut justo accumsan accumsan sed posuere sem. Pellentesque
            sit amet cursus tortor. Nullam pharetra sapien ligula, eleifend pulvinar ex
            tincidunt in. Pellentesque accumsan odio sem, vitae dictum arcu rutrum ut.
            Praesent interdum eget nisi nec mattis.
          </p>
        </div>
        <div class="col-md-5 order-md-1">
          <img
            class="featurette-image img-fluid mx-auto"
            alt="600x600"
            style="width: 640px; height: 426px"
            src="https://images.unsplash.com/photo-1504384764586-bb4cdc1707b0?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            data-holder-rendered="true" />
        </div>
      </div>
      <hr class="divider my-4" />

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">
            And lastly, this one. <span class="text-secondary">Checkmate.</span>
          </h2>
          <p class="lead">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in purus id
            nibh dapibus dictum. Suspendisse vitae diam risus. Nam sagittis ultrices
            ipsum quis aliquet. Praesent aliquet ornare ante, eget cursus metus maximus
            nec. In quis dolor ut justo accumsan accumsan sed posuere sem. Pellentesque
            sit amet cursus tortor. Nullam pharetra sapien ligula, eleifend pulvinar ex
            tincidunt in. Pellentesque accumsan odio sem, vitae dictum arcu rutrum ut.
            Praesent interdum eget nisi nec mattis.
          </p>
        </div>
        <div class="col-md-5">
          <img
            class="featurette-image img-fluid mx-auto"
            data-src="holder.js/500x500/auto"
            alt="600x600"
            style="width: 720px; height: 426px"
            src="https://images.unsplash.com/photo-1531497865144-0464ef8fb9a9?q=80&w=2574&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            data-holder-rendered="true" />
        </div>
      </div>
    </div>
  </main>
</body>

</html>