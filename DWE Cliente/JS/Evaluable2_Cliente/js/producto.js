class Producto {
  id;
  titulo;
  descripcion;
  categoria;
  precio;
  marca;
  imagen;
  cantidad;
  stock;

  constructor(
    id,
    titulo,
    descripcion,
    categoria,
    precio,
    marca,
    imagen,
    cantidad,
    stock
  ) {
    this.id = id;
    this.titulo = titulo;
    this.descripcion = descripcion;
    this.categoria = categoria;
    this.precio = precio;
    this.cantidad = cantidad;
    this.stock = stock;

    // controlar productos sin marca
    if (marca == undefined) {
      this.marca = "Alimentación";
    } else {
      this.marca = marca;
    }

    this.imagen = imagen;
  }
}
