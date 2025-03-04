import { Component } from '@angular/core';

@Component({
  selector: 'app-form',
  standalone: false,
  templateUrl: './form.component.html',
  styleUrl: './form.component.css'
})
export class FormComponent {
  nombreUsuario!: string;
  edadUsuario = 18;
  mostrarMensaje!: boolean;
  mostrarSelect: string = "";
  mostrarBienvenida = false;
  nombreUsuarioForm!: string;
  edadUsuarioForm!: number;
  mayorEdad!: boolean;
  selectForm = "";
  isFormSubmitted: boolean = false;

  comprobarForm() {
    this.isFormSubmitted = true;
    this.mayorEdad = this.edadUsuarioForm >= 18;
  }
  
}
