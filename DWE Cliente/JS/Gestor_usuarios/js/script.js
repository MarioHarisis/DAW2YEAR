const nombreInput = document.querySelector("#FormControlInput1");
const apellidoInput = document.querySelector("#FormControlInput2");
const telefonoInput = document.querySelector("#FormControlInput3");
const generoInput = document.querySelector("#FormControlSelect1");
const depInput = document.querySelector("#FormControlSelect2");
const btnRegistrar = document.querySelector(".animated-button");
const cardContainer = document.querySelector("#card-container");
const filtros = document.querySelectorAll("#filtro");
const filtroVip = document.querySelector("#btn-vip");
const filtroNoVip = document.querySelector("#btn-no-vip");
const buscador = document.querySelector("#buscador");
const mensajeContainer = document.querySelector("#mensaje-container");

let listaUsuarios = [];
let listaFiltrada = [];
let usuario;

// Al cargar la página, recupera los usuarios de sessionStorage
document.addEventListener("DOMContentLoaded", () => {
  const usuariosGuardados = sessionStorage.getItem("listaUsuarios");
  if (usuariosGuardados) {
    listaUsuarios = JSON.parse(usuariosGuardados); // Convierte el string a un array
    listaUsuarios.forEach((usuario) => crearCartaUsuario(usuario));
  }
});

/* Filtros */

// Genero
filtros[0].addEventListener("change", () =>
  filtrarMostrarLista(filtros[0], "genero")
);

filtros[1].addEventListener("change", () =>
  filtrarMostrarLista(filtros[1], "departamento")
);

// Filtros VIP
filtroVip.addEventListener("click", () => aplicarFiltroVip(true));

filtroNoVip.addEventListener("click", () => aplicarFiltroVip(false));

/* Buscador */
buscador.addEventListener("keyup", (e) => {
  const textoBusqueda = e.target.value.toLowerCase();
  let listaFiltrada = [];

  if (textoBusqueda.trim() === "") {
    // Si el texto de búsqueda está vacío, no mostrar el mensaje y todos los user
    cardContainer.innerHTML = "";
    mensajeContainer.innerHTML = "";
    listaUsuarios.forEach((usuario) => crearCartaUsuario(usuario));
  } else {
    // Filtrar por el texto de busqueda
    listaFiltrada = listaUsuarios.filter((usuario) =>
      usuario.nombre.toLowerCase().includes(textoBusqueda)
    );
    // Evitar duplicación de líneas
    cardContainer.innerHTML = "";
    mensajeContainer.innerHTML = "";

    // Crear el mensaje de los resultados
    const mensajeResultados = document.createElement("p");
    mensajeResultados.textContent = `Se han encontrado ${listaFiltrada.length} resultado/s sobre \"${textoBusqueda}\".`;
    mensajeContainer.append(mensajeResultados);

    listaFiltrada.forEach((usuario) => crearCartaUsuario(usuario));
  }
});

/* Registrar usuario */
btnRegistrar.addEventListener("click", (e) => {
  if (
    nombreInput.value.trim() == "" ||
    apellidoInput.value.trim() == "" ||
    telefonoInput.value.trim() == "" ||
    generoInput.value == 0 ||
    depInput.value == 0
  ) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Algún campo está vacío.",
      footer:
        '<a href="#" id="more-info-link">¿Porqué tengo este problema?</a>',
    });
    const moreInfoLink = document.querySelector("#more-info-link");
    moreInfoLink.addEventListener("click", () => {
      Swal.fire(
        "Información",
        "Debes completar todos los campos del apartado 'Creación'.",
        "info"
      );
    });
  } else {
    const nombre = nombreInput.value;
    const apellido = apellidoInput.value;
    const telefono = telefonoInput.value;
    const genero = generoInput.value;
    const departamento = depInput.value;
    const vipCheck = document.querySelector("#cbx-46");

    // Crear usuario
    usuario = new Usuario(
      nombre,
      apellido,
      telefono,
      genero,
      departamento,
      vipCheck.checked
    );
    try {
      crearCartaUsuario(usuario);
      listaUsuarios.push(usuario); // Guardar usuario en la lista
      guardarUsuariosEnSession(); // Guardar lista actualizada en sessionStorage
      mostrarAlert("success", "Usuario creado correctamente");
    } catch (error) {
      mostrarAlert("error", "Error al crear el usuario");
    }
    // Restablecer formulario
    limpiarForm();
  }
});

/* Filtros genero y dept */
function filtrarMostrarLista(listened, filtro) {
  mensajeContainer.textContent = "";

  if (listaUsuarios.length == 0) {
    mensajeContainer.textContent = "Aún no hay usuarios registrados.";
    return;
  }

  cardContainer.innerHTML = "";
  const comparador = listened.value;

  listaFiltrada = listaUsuarios.filter(
    (usuario) => usuario[filtro] == comparador
  );

  if (listaFiltrada.length == 0) {
    mensajeContainer.textContent =
      "Aún no hay usuarios registrados con estas características.";
    return;
  }

  listaFiltrada.forEach((usuario) => crearCartaUsuario(usuario));
  listened.value = 0;
}
/* Crear carta para DOM */
function crearCartaUsuario(usuario) {
  let nuevoUsuario = document.createElement("div");
  nuevoUsuario.innerHTML = "";

  // Asignación img según género
  if (usuario.genero == 1) {
    usuario.imagen = "https://cdn-icons-png.flaticon.com/512/3233/3233508.png";
  } else {
    usuario.imagen = "https://cdn-icons-png.flaticon.com/512/3577/3577099.png";
  }
  usuario.id = listaUsuarios.length + 1;

  // Creación de la carta
  nuevoUsuario.innerHTML = `<div class=" col animate__animated animate__backInDown custom-card data-id="${usuario.id}">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" aria-label="Close"></button>
            <img
              src="${usuario.imagen}"
              class="card-img-top"
              alt="..."
            />
            <div class="card-body custom-card-body h-100">
              <h5 class="card-title">${usuario.nombre} ${usuario.apellido}</h5>
              <p class="card-text mt-3">
                Departamento ${usuario.departamento}<br>
                Telf. ${usuario.telefono}
              </p>
              <p class="card-text">
              VIP <img
              src="${usuario.vipImage}"
              alt="VIP"
              style="width: 40px; height: 40px;" 
            />
              </p>
              <div class="btn-group dropup col-12">
        <button
          type="button"
          class="btn btn-secondary dropdown-toggle"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          data-bs-auto-close="outside"
        >
          Editar usuario
        </button>
        <form class="dropdown-menu p-4 col-12">
        <div class="col-12 menu-editor-title">
        <h4>Menú de edición</h4>
        </div>
          <div class="mt-4">
            <label class="form-label"
              >Departamento:</label
            >
            <select
            class="form-select"
            aria-label="Default select example"
            id="departamento"
          >
            <option selected hidden value="">Selecciona dpt.</option>
            <option>Ventas</option>
            <option>RRHH</option>
            <option>Desarrollo</option>
          </select>
          </div>
          <div class="mt-2">
            <label class="form-label"
              >Telefono:</label
            >
            <input
              type="text"
              class="form-control"
              id="telefono"
              placeholder="Teléfono editado.."
            />
          </div>
            <div class="form-check mt-3">
              <input
                type="checkbox"
                class="form-check-input"
                id="vip"
              />
              <label class="form-check-label">
                VIP
              </label>
            </div>
          <button type="submit" class="btn btn-secondary mt-3 btn-submit">Guardar cambios</button>
        </form>
      </div>
            </div>
          </div>`;
  cardContainer.appendChild(nuevoUsuario);

  // Eliminar usuario
  const eliminarUsuario = nuevoUsuario.querySelector(".btn-close");
  eliminarUsuario.addEventListener("click", () => {
    Swal.fire({
      title: "¿Eliminar usuario?",
      text: "¡Se eliminará el usuario definitivamente!",
      icon: "warning",
      showCancelButton: true,
      cancelButtonColor: "#ec2710",
      confirmButtonText: "Eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "¡Eliminado!",
          text: "Se ha eliminado el usuario.",
          icon: "success",
        });

        // Añadimos todos los usuarios menos el que tenga el mismo ID
        listaUsuarios = listaUsuarios.filter((u) => u.id !== usuario.id);
        // Actualizar sessionStorage
        guardarUsuariosEnSession();
        // Eliminar la carta del DOM
        nuevoUsuario.remove();
      }
    });
  });

  /* Editar usuario */
  const btnGuardarCambios = nuevoUsuario.querySelector(".btn-submit");
  const btnEditarUsuario = nuevoUsuario.querySelector(".dropdown-toggle");
  const nuevoVip = nuevoUsuario.querySelector("#vip");

  // VIP checked si ya lo es
  btnEditarUsuario.addEventListener("click", (e) => {
    if (usuario.vip) {
      nuevoVip.checked = true;
    }
  });

  btnGuardarCambios.addEventListener("click", (e) => {
    const nuevoTelefono = nuevoUsuario.querySelector("#telefono");
    const nuevoDepartamento = nuevoUsuario.querySelector("#departamento");

    // Comprobación cambio telefono
    if (!nuevoTelefono.value == "") {
      usuario.telefono = nuevoTelefono.value;
    }

    // Comprobación cambio dept.
    if (!nuevoDepartamento.value == "") {
      usuario.departamento = nuevoDepartamento.value;
    }

    // Asignación de imágenes según VIP
    comprobarVip(usuario, nuevoVip);

    guardarUsuariosEnSession();
  });
}

// Función para guardar usuarios en sessionStorage
function guardarUsuariosEnSession() {
  sessionStorage.setItem("listaUsuarios", JSON.stringify(listaUsuarios));
}

// Función para mostrar las alert
function mostrarAlert(option, text) {
  if (option == "success") {
    return Swal.fire({
      icon: "success",
      title: `${text}`,
      showConfirmButton: false,
      timer: 1200,
    });
  } else if (option == "error") {
    return Swal.fire({
      icon: "error",
      title: "Oops...",
      text: `${text}`,
      confirmButtonColor: "#415A77",
    });
  }
}

// Limpiar el formulario
function limpiarForm() {
  nombreInput.value = "";
  apellidoInput.value = "";
  telefonoInput.value = "";
  generoInput.value = "0";
  depInput.value = "0";
}

// Asignación img según VIP
function comprobarVip(usuario, vip) {
  if (vip.checked) {
    usuario.vip = true;
    usuario.vipImage = "https://cdn-icons-png.flaticon.com/512/276/276020.png";
    console.log(usuario.vip);
  } else {
    usuario.vip = false;
    usuario.vipImage =
      "https://uxwing.com/wp-content/themes/uxwing/download/checkmark-cross/cross-icon.png";
  }
}

function aplicarFiltroVip(filtroVip) {
  cardContainer.innerHTML = "";
  if (filtroVip == true) {
    listaFiltrada = listaUsuarios.filter((usuario) => usuario.vip);
  } else {
    listaFiltrada = listaUsuarios.filter((usuario) => usuario.vip == false);
  }
  listaFiltrada.forEach((usuario) => crearCartaUsuario(usuario));
}
