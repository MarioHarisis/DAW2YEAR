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
    comprobarStock(producto); // comprobar todos los stock
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
      const row = tBody.querySelector(`[data-id="${producto.id}"]`); // seleccionar fila a editar
      row.querySelector(".cantidad").textContent = producto.cantidad;
      row.querySelector(".precio").textContent = precioCarrito;

      /* tambien podríamos: en este caso seleccionaríamos los text directamente

      const cantidadText = tBody.querySelector(`[data-id="${producto.id}"] .cantidad`);
      const precioText = tBody.querySelector(`[data-id="${producto.id}"] .precio`); 
      cantidadText.textContent = producto.cantidad;
      precioText.textContent = precioCarrito;

      */
    } else {
      producto.cantidad = 1;

      // se dibuja si no estaba previamente
      const carritoRow = document.createElement("tr");
      carritoRow.setAttribute("data-id", producto.id); // Usar el id para identificar la fila
      carritoRow.classList.add(
        "animate__animated",
        "animate__backInLeft",
        "carritoRow"
      );
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
          comprobarStock(prod); // comprobamos el nuevo stock
        }
      });

      listaCarrito.length = 0;
      tBody.innerHTML = ``;
    }
  });
});

tBody.addEventListener("click", (e) => {
  if (e.target.classList.contains("btn-eliminar")) {
    // verificar si el botón pulsado es un eliminar

    const filaEliminar = e.target.closest("tr"); // seleccionar fila del producto
    const idProducto = filaEliminar.getAttribute("data-id");
    let cantidadCarritoRow = filaEliminar.querySelector(".cantidad");

    let producto = listaCarrito.find((prod) => prod.id == idProducto); // encontrar producto en listaCarrito
    if (producto) {
      producto.cantidad--; // restar 1 en cantidad

      if (producto.cantidad == 0) {
        // eliminar si se queda en 0
        listaCarrito = listaCarrito.filter((prod) => prod.id != producto.id); // sacar de la lista
        filaEliminar.remove(); //eliminar el tr
      } else {
        cantidadCarritoRow.textContent = `${producto.cantidad}`; //modificar la cantidad en carrito
      }
    } else {
      console.log("No se encontró el producto en el carrito");
      return;
    }
  }
});

// comprobar existencias
function comprobarStock(producto) {
  // informar de stock bajo en producto
  let stockText = document.querySelector(
    `[data-id="${producto.id}"] .stock-text` // encontrar el campo .stock-text por id
  );

  stockText.classList.add("text-danger"); // establecer color texto stock

  if (producto.stock == 0) {
    stockText.textContent = "Fuera de stock";
  } else if (producto.stock <= 5) {
    stockText.textContent = `Quedan: ${producto.stock} en stock`;
  } else {
    stockText.textContent = " ";
  }
}
