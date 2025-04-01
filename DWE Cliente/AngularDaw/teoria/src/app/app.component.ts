import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  standalone: false,
  styleUrl: './app.component.css'
})
export class AppComponent {
  
  title = 'teoria';
  autor = 'Mario';
  seleccion!: string;


  constructor(private router: Router){}

  navegar() {
  console.log("Navegando");
  this.router.navigate([("listado")]);
  /* this.router.navigate(["listado", 5]); */
  }

}
