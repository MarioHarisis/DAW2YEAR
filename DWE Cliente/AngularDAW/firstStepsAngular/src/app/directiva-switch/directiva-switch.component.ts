import { Component } from '@angular/core';

@Component({
  selector: 'app-directiva-switch',
  standalone: false,
  templateUrl: './directiva-switch.component.html',
  styleUrl: './directiva-switch.component.css'
})
export class DirectivaSwitchComponent {
  estadoPedido!: string;
  idioma!: string;
  tipoArchivo!: string;
}
