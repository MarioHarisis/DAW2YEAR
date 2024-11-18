class Tarea {
  id = 0;
  titulo = "";
  descripcion = "";
  fecha = new Date();
  prioritaria = false;
  prioridad = "";
  completa = false;
  imagen;
}

const formulario = document.querySelector(".form");
const titulo = document.querySelector("#titulo");
const descripcion = document.querySelector("#descripcion");
const prioridad = document.querySelector("#select");
const fecha = document.querySelector("#fecha");
const checkbox = document.querySelector(".form-checkbox");
const tareasContainer = document.querySelector(".tareas-container");

// lista de tareas
const listaTareas = [];
const listaTareasBaja = [];
const listaTareasMedia = [];
const listaTareasAlta = [];
const tarea = new Tarea();

mostrarMensajeTareas();

formulario.addEventListener("submit", function (event) {
  event.preventDefault();

  // Comprobar si el formulario está vacío
  if (
    titulo.value.replace(/\s+/g, "") == "" &&
    descripcion.value.replace(/\s+/g, "") == "" &&
    prioridad.value == "" &&
    fecha.value == ""
  ) {
    mostrarAlerta("Completa el formulario para crear una tarea nueva", true);
    return;
  }

  /* Titulo */
  if (titulo.value.replace(/\s+/g, "") == "") {
    mostrarAlerta("Debes introducir algún título", true);
    return;
  } else {
    tarea.titulo = titulo.value;
  }

  /* Descripcion */
  if (descripcion.value.replace(/\s+/g, "") == "") {
    tarea.descripcion = "Sin descripción";
  } else {
    tarea.descripcion = descripcion.value;
  }

  /* Prioridad */
  if (prioridad.value == "") {
    mostrarAlerta("Debes seleccionar alguna prioridad", true);
    return;
  } else {
    tarea.prioridad = prioridad.value.toLowerCase();
    tarea.imagen = `/images/img-prioridad-${tarea.prioridad}.png`;
  }

  /* Fecha */
  if (fecha.value == "") {
    mostrarAlerta("Selecciona una fecha", true);
    return;
  } else {
    tarea.fecha = fecha.value;
  }

  /* Checkbox */
  if (checkbox.checked) {
    tarea.prioritaria = true;
    console.log("Checkbox checked");
  }

  /* Pasar tarea al DOM*/
  const nuevaTarea = document.createElement("div");
  nuevaTarea.classList.add("tareas");
  nuevaTarea.setAttribute("tarea-id", listaTareas.length);
  nuevaTarea.setAttribute("id", tarea.prioridad);

  // Agregar el contenido de la tarea dentro del contenedor
  nuevaTarea.innerHTML = `
    <img src=${tarea.imagen} />
      <div class="tareas-content">
        <h4>${tarea.titulo}</h4>
        <p>${tarea.descripcion}</p>
        <p><strong>Fecha:</strong> ${tarea.fecha}</p>
        ${tarea.prioritaria ? "<p><strong>Prioritaria</strong></p>" : ""}
        <input type="button" value="Completar" class="img-btn" />
        </div>
  `;
  tareasContainer.appendChild(nuevaTarea);
  listaTareas.push(nuevaTarea);
  mostrarAlerta("Tarea creada con éxito");

  // Mensajes info tareas
  if (listaTareas.length < 1) {
    const mensajeTareas = document.querySelector(".mensaje-tareas");
    mensajeTareas.remove();
  } else {
    mostrarMensajeTareas();
  }

  // Añadir cada tarea a su lista correspondiente
  switch (tarea.prioridad) {
    case "baja":
      listaTareasBaja.push(nuevaTarea);
      break;
    case "media":
      listaTareasMedia.push(nuevaTarea);
      break;
    case "alta":
      listaTareasAlta.push(nuevaTarea);
      break;
  }

  formulario.reset();
});

/* Completar-eliminar las tareas */
tareasContainer.addEventListener("click", function (event) {
  if (event.target.classList.contains("img-btn")) {
    const tareaElement = event.target.closest(".tareas");
    const tareaId = parseInt(tareaElement.getAttribute("tarea-id"));

    if (tareaElement) {
      tareaElement.remove();
      listaTareas.splice(tareaId, 1); // Elimina una tarea de listaTareas en la posición tareaId
      mostrarAlerta(`Tarea eliminada correctamente`, true);
      mostrarMensajeTareas();
    }
  }
});

/* Filtros de búsqueda */
const filtroButtons = document.querySelectorAll(".form-button");
filtroButtons.forEach((button) => {
  button.addEventListener("click", function () {
    tareasContainer.innerHTML = "";
    if (button.classList == "form-button btn-todas") {
      listaTareas.forEach((tarea) => {
        tareasContainer.appendChild(tarea);
      });
    } else {
      listaTareas.forEach((tarea) => {
        if (tarea.id == button.id) {
          tareasContainer.appendChild(tarea);
        }
      });
    }
  });
});

/* Modo oscuro */
const darkModeBtn = document.querySelector(".dark-mode-toggle");
const darkModeInfo = document.querySelector(".dark-mode__info");
darkModeBtn.addEventListener("click", toggleDarkMode);

const filtrosButtons = document.querySelector(".form-button");
filtrosButtons.addEventListener("click", function (event) {
  switch (true) {
    case event.target.classList.contains("btn-todas"):
      break;
    case event.target.classList.contains("btn-baja"):
      break;
    case event.target.classList.contains("btn-media"):
      break;
    case event.target.classList.contains("btn-alta"):
      console.log("Entra");
      for (const boton of listaTareasAlta) {
        boton.appendChild(tareasContainer);
      }
      break;
    default:
      break;
  }
});

function toggleDarkMode() {
  // Alterna la clase del modo oscuro en el body
  document.body.classList.toggle("dark-mode");

  // Almacena el estado actual del modo oscuro en una variable
  const isDarkMode = document.body.classList.contains("dark-mode");

  // Actualiza el texto de button e info basado en el estado
  darkModeBtn.textContent = isDarkMode ? "☀️" : "🌙";
  darkModeInfo.textContent = isDarkMode ? "Light Mode" : "Dark Mode";
}

// Administrar que alerta se muestra
function mostrarAlerta(mensaje, error) {
  const alerta = document.createElement("P");

  if (error === true) {
    alerta.classList.add("error");
  } else {
    alerta.classList.add("exito");
  }

  alerta.textContent = mensaje;
  formulario.appendChild(alerta);

  setTimeout(() => {
    alerta.remove();
  }, 5000);
}

// Mostramos el éxito al enviar formulario
function mostrarExito(mensaje) {
  exito.textContent = mensaje;
  exito.classList.add("exito");
  formulario.appendChild(exito);

  // Hacer desaparecer el mensaje de exito después de 5s
  setTimeout(() => {
    exito.remove();
  }, 5000);
}

// Mostramos un error en la pantalla
function mostrarError(mensaje) {
  error.textContent = mensaje;
  error.classList.add("error");
  formulario.appendChild(error);

  // Hacer desaparecer el mensaje de error después de 5s
  setTimeout(() => {
    error.remove();
  }, 5000);
}

function mostrarMensajeTareas() {
  // Buscar mensaje de tareas si ya existe
  let mensajeTareas = document.querySelector(".mensaje-tareas");

  // Si el array de tareas está vacío y el mensaje no existe, se crea
  if (listaTareas.length === 0 && !mensajeTareas) {
    mensajeTareas = document.createElement("h3");
    mensajeTareas.classList.add("mensaje-tareas");
    mensajeTareas.textContent = "Aquí aparecerán tus tareas";
    tareasContainer.appendChild(mensajeTareas);
  }
  // Si el array de tareas tiene elementos y el mensaje existe, se elimina
  else if (listaTareas.length > 0 && mensajeTareas) {
    mensajeTareas.remove();
  }
}
