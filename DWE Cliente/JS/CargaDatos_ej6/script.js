/* ## Ejercicio 6:

Realiza una aplicación que simule la carga de los usuarios dentro del sistema. Para ello sigue los sugerentes pasos

- Usar **fetch** para hacer una llamada a una API pública de prueba, como `https://jsonplaceholder.typicode.com/users`.
- Mostrar un mensaje de "Cargando datos..." mientras se espera la respuesta de la API (simulando un tiempo de espera).
- Después de obtener los datos, mostrar una lista de usuarios en el navegador (nombre, email, y ciudad).
- Añadir un botón que, al pulsarlo, simule la carga de más datos después de 2 segundos (usando `setTimeout`). */

listaUsuarios = [];
const listaDom = document.querySelector(".container");
const btnVerMas = document.querySelector(".btn");
const mensaje = document.createElement("h5");

fetch("https://jsonplaceholder.typicode.com/users")
  .then((response) => response.json())
  .then((response1) => {
    btnVerMas.disabled = true;
    mensaje.innerHTML = `Cargando datos...`;
    listaDom.appendChild(mensaje);

    listaUsuarios = response1;
    setTimeout(() => {
      listaUsuarios.forEach((element) => {
        mensaje.remove();
        const usuario = document.createElement("div");
        usuario.innerHTML = `
          <ul class="list-group list-group-horizontal-md">
            <li class="list-group-item">${element.name}</li>
            <li class="list-group-item">${element.email}</li>
            <li class="list-group-item">${element.address.city}</li>
        </ul>`;
        listaDom.appendChild(usuario);
      });
      // reactivar el botón cuando se hayan cargado todos los usuarios
      btnVerMas.disabled = false;
    }, 4000);
  })
  .catch(() => {
    mensaje.innerHTML = ``;
    mensaje.innerHTML = "No se ha podido conectar";
    listaDom.appendChild(mensaje);
  });

// Acción boton Ver más
btnVerMas.addEventListener("click", () => {
  mensaje.innerHTML = `Cargando nuevos datos...`;
  listaDom.appendChild(mensaje);
  setTimeout(() => {
    mensaje.remove();
    const usuarioDatosNuevos = document.createElement("div");
    usuarioDatosNuevos.innerHTML = `
        <ul class="list-group list-group-horizontal-md">
          <li class="list-group-item">Usuario ver mas</li>
          <li class="list-group-item">usuariovermas@email.com</li>
          <li class="list-group-item">Dirección usuario ver mas</li>
      </ul>`;
    listaDom.appendChild(usuarioDatosNuevos);
  }, 2000);
});
