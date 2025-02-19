const tBody = document.querySelector(".tbody"); // seleccionar body de tabla carrito
const cardContainer = document.querySelector("#card-container");
const filtros = document.querySelectorAll("#filtro");
const buscador = document.querySelector("#buscador");
const mensajeContainer = document.querySelector("#mensaje-container");

const url = "https://dummyjson.com/products";
let productos = [];
let listaCarrito = [];
let listaFiltrada = [];

// Ejecutar la consulta y mostrar productos al cargar la página
document.addEventListener("DOMContentLoaded", () => {
  consultaProductos();
});

// traer productos de la url
async function consultaProductos() {
  let respuesta = await fetch(url);
  let respuestaJson = await respuesta.json();

  respuestaJson.products.forEach((element) => {
    // se crean los productos con sus atributos
    const producto = new Producto(
      element.id,
      element.title,
      element.description,
      element.category,
      element.price,
      element.brand,
      element.images[0], // añadir sólo la primera imágen de cada producto (algunas tienen 1 otras tienen varias)
      0,
      element.stock
    );

    productos.push(producto);
  });

  mostrarProductos(productos);
}

function mostrarProductos(lista) {
  cardContainer.innerHTML = "";
  lista.forEach((producto) => {
    cardContainer.appendChild(crearCartaProducto(producto)); //añadir cada carta al main
  });
}

/* Crear carta para DOM */
function crearCartaProducto(producto) {
  let nuevoProducto = document.createElement("div");
  nuevoProducto.classList.add(
    "col",
    "animate__animated",
    "animate__backInDown",
    "custom-card",
    "mb-3"
  );

  nuevoProducto.setAttribute("data-id", producto.id); // con esto lo encontraremos depués para organizar stock
  nuevoProducto.innerHTML = `
  <div  id=${producto.id} class="card-body custom-card-body ">
  <img src="${producto.imagen}" class="card-img-top" alt="${producto.titulo}" />
      <h5 class="card-title">${producto.titulo}</h5>
      <p class="card-text">
        ${producto.categoria} <br>
        ${producto.marca} <br>
        </p>
        <p class="card-text stock-text">
        
      </p>
        <p class="card-text fw-bold">
        ${producto.precio}€ <br>
      </p>
    </div>
    <button type="button" class="btn btn-secondary btn-carrito">
          Añadir al carrito
        </button>
  `;

  if (producto.stock <= 5) {
    let stockRow = nuevoProducto.querySelector(".stock-text");
    stockRow.classList.add("text-danger");
    stockRow.textContent = `Quedan ${producto.stock} en stock`;
  }

  // boton "añadir al carrito" dentro de las card
  const btnCarrito = nuevoProducto.querySelector(".btn-carrito");

  btnCarrito.addEventListener("click", () => {
    if (producto.cantidad == producto.stock || producto.stock == 0) {
      // no permitir comprar en caso de que noo queden existencias
      mostrarAlert("error", "No hay más existencias de este producto");
      return;
    }

    // dibujar fila en carrito
    if (listaCarrito.find((prod) => prod.id === producto.id)) {
      producto.cantidad++;
      let precioCarrito = (producto.precio * producto.cantidad).toFixed(2);

      // Actualizar la fila correspondiente en la tabla (buscando la fila del producto)
      const row = tBody.querySelector(`[data-id="${producto.id}"]`);
      row.querySelector(".cantidad").textContent = producto.cantidad;
      row.querySelector(".precio").textContent = precioCarrito;
    } else {
      producto.cantidad = 1;

      // se dibuja si no estaba previamente
      const carritoRow = document.createElement("tr");
      carritoRow.setAttribute("data-id", producto.id); // Usar el id para identificar la fila
      carritoRow.classList.add("animate__animated", "animate__backInLeft");
      carritoRow.innerHTML = `
      <td>${producto.titulo}</td>
      <td class="cantidad">${producto.cantidad}</td>
      <td class="precio">${producto.precio}€</td>
      <td><button class="btn btn-danger btn-eliminar" type="button">Eliminar</button></td>
      `;
      listaCarrito.push(producto); // agregar producto a lista del carrito
      tBody.appendChild(carritoRow);
    }
  });

  return nuevoProducto; // devolver el html que se insertará en el cardContainer;
}

function eliminarProducto(id) {
  // Filtra nueva lista sin el producto pasado por param
  productos.filter((producto) => producto.id !== id);
}

// evento boton Comprar de carrito
const btnComprar = document.querySelector(".animated-button");
btnComprar.addEventListener("click", () => {
  if (listaCarrito.length == 0) {
    mostrarAlert("error", "El carrito aún está vacío");
    return;
  }
  let totalCompra = 0;
  listaCarrito.forEach((prod) => {
    totalCompra += prod.precio * prod.cantidad; //calcular precio total redondeado a 2 decimales
  });

  Swal.fire({
    title: "¿Realizar pedido?",
    text: `Se realizará un pedido con importe ${totalCompra}€`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Finalizar pedido",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "¡Hecho!",
        text: "Tu pedido llegará muy pronto.",
        icon: "success",
      });

      // reducir stock de rpodcutos comprados
      listaCarrito.forEach((prod) => {
        //encontrar y almacenar el producto al que quitar stock
        const productoStock = productos.find(
          (producto) => producto.id === prod.id
        );

        // si lo ecnuentra, reducir el stock
        if (productoStock) {
          productoStock.stock -= prod.cantidad;
          comprobarStock(prod);
        }
      });

      listaCarrito.length = 0;
      tBody.innerHTML = ``;
    }
  });
});

// comprobar existencias visibles
function comprobarStock(producto) {
  // informar de stock bajo en producto
  let stockText = document.querySelector(
    `[data-id="${producto.id}"] .stock-text`
  );

  if (producto.stock == 0) {
    stockText.textContent = "Fuera de stock";
  } else if (producto.stock <= 5) {
    stockText.textContent = `Quedan: ${producto.stock} en stock`;
  } else {
    stockText.textContent = " ";
  }
}
// Al cargar la página, recupera los usuarios de sessionStorage
/* document.addEventListener("DOMContentLoaded", () => {
  const usuariosGuardados = sessionStorage.getItem("listaUsuarios");
  if (usuariosGuardados) {
    listaUsuarios = JSON.parse(usuariosGuardados); // Convierte el string a un array
    listaUsuarios.forEach((usuario) => crearCartaUsuario(usuario));
  }
}); */

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
  } else {
    return Swal.fire({
      icon: "error",
      title: "Oops...",
      text: `${text}`,
      confirmButtonColor: "#415A77",
    });
  }
}
