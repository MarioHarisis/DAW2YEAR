import { Component } from '@angular/core';
import { Product } from '../model/product';
@Component({
  selector: 'app-directiva-for',
  standalone: false,
  templateUrl: './directiva-for.component.html',
  styleUrl: './directiva-for.component.css'
})
export class DirectivaForComponent {
  listaProductos:Product[] = [];
  producto!: Product;
  nombreProducto!: string;
  precioProducto!: string;
  tipoProducto!: string;

  listaNombres: string[] = [
    "Alejandro",
    "Beatriz",
    "Carlos",
    "Diana",
    "Eduardo",
    "Fernanda",
    "Gabriel",
    "Héctor",
    "Isabel",
    "Javier"
  ];


  listaTareas: string[] = [
    'Comprar comida',
    'Lavar la ropa',
    'Estudiar para el examen',
    'Ir al gimnasio',
    'Leer un libro'
  ];

  crearProducto() {
    // crear nuevo producto
    this.producto = new Product(this.nombreProducto, this.precioProducto, this.tipoProducto);
    this.listaProductos.push(this.producto); // agregar a la lista de productos

    // reestablecer valores
    this.nombreProducto = '';
    this.precioProducto = '';
    this.tipoProducto = '';
  }

  eliminarTarea(tarea:string) {
    // quitar la tarea de la lista
    this.listaTareas = this.listaTareas.filter((item) => item!= tarea);
  }

}
