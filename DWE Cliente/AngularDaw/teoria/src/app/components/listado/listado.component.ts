import { Component } from '@angular/core';
import { log } from 'node:console';
import { Conocimiento } from '../../model/modelos';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-listado',
  standalone: false,
  templateUrl: './listado.component.html',
  styleUrl: './listado.component.css'
})
export class ListadoComponent {
  
  nombre = 'Mario';
  nombreConocimiento = '';
  nivelConocimiento = '';
  conocimientos: Conocimiento[] = [];
  mostrar = true;


  guardarElemento() {

    if (this.nombreConocimiento.length == 0 && this.nivelConocimiento.length == 0) {
      Swal.fire({
        title: "Fallo",
        icon: "warning",
        text: "faltan datos por rellenar",
      });
    }else {
      // interfaz creada en model/modelos.ts
      let conocimiento: Conocimiento = {
        nombre: this.nombreConocimiento, 
        nivel: this.nivelConocimiento
      };
    
      // añadir el conocimiento en interfaz a la lista de Conocimientos
      this.conocimientos.push(conocimiento);
      this.vaciarDatos();

    }
  }

  mostrarConocimientos() {
    
    }

  vaciarDatos() {
    this.nombreConocimiento = '';
    this.nivelConocimiento = '';
  }
}
