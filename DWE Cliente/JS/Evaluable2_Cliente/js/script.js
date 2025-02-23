const tBody = document.querySelector(".tbody"); // seleccionar body de tabla carrito
const mensajeContainer = document.querySelector("#mensaje-container");
const navbarNav = document.querySelector(".navbar-nav");
const cardContainer = document.querySelector("#card-container");

const url = "https://dummyjson.com/products";
let productos = [];
let listaCarrito = [];
let listaCategoria = [];
let listaMarca = [];

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

    // crear lista de categorias sin repetidos
    if (!listaCategoria.includes(producto.categoria)) {
      listaCategoria.push(producto.categoria);
    }

    // crear lista de marcas sin repetidos
    if (!listaMarca.includes(producto.marca)) {
      listaMarca.push(producto.marca);
    }

    productos.push(producto);
  });
  mostrarProductos(productos);
  crearFiltros(listaCategoria, "Categoria");
  crearFiltros(listaMarca, "Marca");
}

// dibujar cartas en dom con lista de prod
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
          Añadir al carrito<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
</svg>
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

// boton "comprar" del carrito
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
        title: "Tu pedido llegará muy pronto.",
        icon: "success",
        html: `
        <div class="swal-container">
        <div class="loader">
  <div class="truckWrapper">
    <div class="truckBody">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 198 93"
        class="trucksvg"
      >
        <path
          stroke-width="3"
          stroke="#282828"
          fill="#F83D3D"
          d="M135 22.5H177.264C178.295 22.5 179.22 23.133 179.594 24.0939L192.33 56.8443C192.442 57.1332 192.5 57.4404 192.5 57.7504V89C192.5 90.3807 191.381 91.5 190 91.5H135C133.619 91.5 132.5 90.3807 132.5 89V25C132.5 23.6193 133.619 22.5 135 22.5Z"
        ></path>
        <path
          stroke-width="3"
          stroke="#282828"
          fill="#7D7C7C"
          d="M146 33.5H181.741C182.779 33.5 183.709 34.1415 184.078 35.112L190.538 52.112C191.16 53.748 189.951 55.5 188.201 55.5H146C144.619 55.5 143.5 54.3807 143.5 53V36C143.5 34.6193 144.619 33.5 146 33.5Z"
        ></path>
        <path
          stroke-width="2"
          stroke="#282828"
          fill="#282828"
          d="M150 65C150 65.39 149.763 65.8656 149.127 66.2893C148.499 66.7083 147.573 67 146.5 67C145.427 67 144.501 66.7083 143.873 66.2893C143.237 65.8656 143 65.39 143 65C143 64.61 143.237 64.1344 143.873 63.7107C144.501 63.2917 145.427 63 146.5 63C147.573 63 148.499 63.2917 149.127 63.7107C149.763 64.1344 150 64.61 150 65Z"
        ></path>
        <rect
          stroke-width="2"
          stroke="#282828"
          fill="#FFFCAB"
          rx="1"
          height="7"
          width="5"
          y="63"
          x="187"
        ></rect>
        <rect
          stroke-width="2"
          stroke="#282828"
          fill="#282828"
          rx="1"
          height="11"
          width="4"
          y="81"
          x="193"
        ></rect>
        <rect
          stroke-width="3"
          stroke="#282828"
          fill="#DFDFDF"
          rx="2.5"
          height="90"
          width="121"
          y="1.5"
          x="6.5"
        ></rect>
        <rect
          stroke-width="2"
          stroke="#282828"
          fill="#DFDFDF"
          rx="2"
          height="4"
          width="6"
          y="84"
          x="1"
        ></rect>
      </svg>
    </div>
    <div class="truckTires">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 30 30"
        class="tiresvg"
      >
        <circle
          stroke-width="3"
          stroke="#282828"
          fill="#282828"
          r="13.5"
          cy="15"
          cx="15"
        ></circle>
        <circle fill="#DFDFDF" r="7" cy="15" cx="15"></circle>
      </svg>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 30 30"
        class="tiresvg"
      >
        <circle
          stroke-width="3"
          stroke="#282828"
          fill="#282828"
          r="13.5"
          cy="15"
          cx="15"
        ></circle>
        <circle fill="#DFDFDF" r="7" cy="15" cx="15"></circle>
      </svg>
    </div>
    <div class="road"></div>

    <svg
      xml:space="preserve"
      viewBox="0 0 453.459 453.459"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      xmlns="http://www.w3.org/2000/svg"
      id="Capa_1"
      version="1.1"
      fill="#000000"
      class="lampPost"
    >
      <path
        d="M252.882,0c-37.781,0-68.686,29.953-70.245,67.358h-6.917v8.954c-26.109,2.163-45.463,10.011-45.463,19.366h9.993
c-1.65,5.146-2.507,10.54-2.507,16.017c0,28.956,23.558,52.514,52.514,52.514c28.956,0,52.514-23.558,52.514-52.514
c0-5.478-0.856-10.872-2.506-16.017h9.992c0-9.354-19.352-17.204-45.463-19.366v-8.954h-6.149C200.189,38.779,223.924,16,252.882,16
c29.952,0,54.32,24.368,54.32,54.32c0,28.774-11.078,37.009-25.105,47.437c-17.444,12.968-37.216,27.667-37.216,78.884v113.914
h-0.797c-5.068,0-9.174,4.108-9.174,9.177c0,2.844,1.293,5.383,3.321,7.066c-3.432,27.933-26.851,95.744-8.226,115.459v11.202h45.75
v-11.202c18.625-19.715-4.794-87.527-8.227-115.459c2.029-1.683,3.322-4.223,3.322-7.066c0-5.068-4.107-9.177-9.176-9.177h-0.795
V196.641c0-43.174,14.942-54.283,30.762-66.043c14.793-10.997,31.559-23.461,31.559-60.277C323.202,31.545,291.656,0,252.882,0z
M232.77,111.694c0,23.442-19.071,42.514-42.514,42.514c-23.442,0-42.514-19.072-42.514-42.514c0-5.531,1.078-10.957,3.141-16.017
h78.747C231.693,100.736,232.77,106.162,232.77,111.694z"
      ></path>
    </svg>
  </div>
</div>
</div>
        `,
      });

      listaCarrito.forEach((prod) => {
        //encontrar y almacenar el producto al que quitar stock
        const productoStock = productos.find(
          (producto) => producto.id === prod.id
        );

        // si lo ecnuentra, reducir el stock de rpodcutos comprados
        if (productoStock) {
          productoStock.stock -= prod.cantidad;
          comprobarStock(prod); // comprobamos el nuevo stock
        }
      });

      listaCarrito.length = 0;
      tBody.innerHTML = ``;
    }
  });

  /* TO DO: factura pase a ser lista de pedidos, que se puedan ver todos los pedidos que se hayan realizado */
});

// botón "eliminar" del carrito
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

// relleno de filtros en nav
function crearFiltros(lista, tipo) {
  const select = document.querySelector(`#${tipo}`);
  lista.forEach((element) => {
    select.appendChild(createOption(element, element));
  });
}

// listener select categorias y marcas
let categoriaSeleccionada = 0;
let marcaSeleccionada = 0;
const selectCategoria = document.querySelector("#Categoria");
selectCategoria.addEventListener("change", (e) => {
  // cambiar las marcas que aparecen dependiendo de la categoría seleccionada
  const selectMarca = document.querySelector("#Marca");
  selectMarca.innerHTML = "";

  // Agregar opción por defecto y seleccionarla
  const opcionPorDefecto = createOption(0, "Todas las marcas");
  selectMarca.appendChild(opcionPorDefecto);
  opcionPorDefecto.selected = true;
  marcaSeleccionada = 0;

  categoriaSeleccionada = e.target.value;

  // comprobar que no se seleccionan todas las categorias
  if (categoriaSeleccionada != 0) {
    let prodEnCategoria = productos.filter(
      (prod) => prod.categoria == categoriaSeleccionada // crear lista con productos que tengan esta categoria
    );

    // Usar un Set para almacenar marcas únicas
    let marcasUnicas = new Set(prodEnCategoria.map((prod) => prod.marca));

    marcasUnicas.forEach((marca) => {
      // crear opción para cada marca y agregarlo al select
      selectMarca.appendChild(createOption(marca, marca));
    });
  }
});

// listener marcas
const selectMarca = document.querySelector("#Marca");
selectMarca.addEventListener("change", (e) => {
  marcaSeleccionada = e.target.value; // ver la marca que se ha seleccionado
  console.log("MARCASELECCIONADA");

  console.log(marcaSeleccionada);
});

// crear opcion para select
function createOption(value, textContent) {
  const option = document.createElement("option");
  option.id = value;
  option.value = value;
  option.textContent = textContent;
  return option;
}

// listener botón filtros
document.querySelector(".btn-filtros").addEventListener("click", () => {
  console.log("BTN FILTROS");

  console.log(categoriaSeleccionada);
  console.log(marcaSeleccionada);

  if (categoriaSeleccionada == 0) {
    // SIN categoría
    if (marcaSeleccionada == 0) {
      mostrarProductos(productos); // mostrar todos los productos
    } else {
      // si se selecciona SOLO marca

      let listaMarca = productos.filter(
        (prod) => prod.marca == marcaSeleccionada
      );
      mostrarProductos(listaMarca); // mostrar por marca
    }
  } else {
    // si se selecciona categoria

    let listaCategoria = productos.filter(
      (prod) => prod.categoria == categoriaSeleccionada
    );

    if (marcaSeleccionada == 0) {
      // SIN marca CON categoría
      // SOLO categoría SIN marca
      mostrarProductos(listaCategoria);
    } else {
      // CON categoría CON marca

      let listaMarca = listaCategoria.filter(
        (prod) => prod.marca == marcaSeleccionada
      );
      mostrarProductos(listaMarca); // mostrar prod que coincidan con categoria y con marca
    }
  }
});

//listener btn precios alto y bajo
document.querySelector(".btn-group").addEventListener("click", (e) => {
  let domActual = document.querySelectorAll(".card-body");
  let productosActual = [];

  domActual.forEach((card) => {
    productos.forEach((prod) => {
      // encontrar los productos que están en el dom
      if (card.id == prod.id) {
        productosActual.push(prod); //agregarlos a la lista para ordenar por precio
      }
    });
  });

  if (e.target.id == "precio-bajo") {
    // comprobar si se ha seleccionado precio mayor o menor para ordenar

    productosActual.sort((a, b) => a.precio - b.precio); // ordenar por precio MENOR
  } else {
    productosActual.sort((a, b) => b.precio - a.precio); // ordenar por precio MAYOR
  }

  mostrarProductos(productosActual); // dibujar en el dom
});

// input buscar
document.querySelector("#buscador").addEventListener("keyup", (e) => {
  const textoBusqueda = e.target.value.toLowerCase();
  let listaFiltrada = [];

  if (textoBusqueda.trim() === "") {
    // Si el texto de búsqueda está vacío, no mostrar mensaje y mostrar todos los productos
    cardContainer.innerHTML = "";
    mensajeContainer.innerHTML = "";
    mostrarProductos(productos);
  } else {
    // Filtrar por el texto de busqueda
    listaFiltrada = productos.filter((prod) =>
      prod.titulo.toLowerCase().includes(textoBusqueda)
    );
    // Evitar duplicación de líneas
    cardContainer.innerHTML = "";
    mensajeContainer.innerHTML = "";

    // Crear el mensaje de los resultados
    const mensajeResultados = document.createElement("p");
    mensajeResultados.textContent = `Se han encontrado ${listaFiltrada.length} resultado/s sobre \"${textoBusqueda}\".`;
    mensajeContainer.append(mensajeResultados);

    mostrarProductos(listaFiltrada);
  }
});

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
