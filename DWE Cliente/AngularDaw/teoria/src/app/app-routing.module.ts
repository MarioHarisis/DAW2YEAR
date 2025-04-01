import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AsignaturasComponent } from './components/asignaturas/asignaturas.component';
import { TecnologiasComponent } from './components/tecnologias/tecnologias.component';
import { ListadoComponent } from './components/listado/listado.component';
import { ErrorComponent } from './components/error/error.component';

// ESTE ES EL MODULO DE GESTIÓN DE RUTAS
const routes: Routes = [
  {path: '', redirectTo: 'asignaturas', pathMatch: 'full'}, // redirecciona si no se especifica ruta
  {path: 'asignaturas', component: AsignaturasComponent},
  // ruta padre 'tecnologias' con dos rutas hijas
  {path: 'tecnologias', component: TecnologiasComponent, 
    children:[
      {path: 'angular', component: AsignaturasComponent},
      {path: 'react', component: ListadoComponent}
    ]},
  {path: 'listado', component: ListadoComponent},
  {path: '**', component: ErrorComponent} // ERROR DEBE SER LA ULTIMA SIEMPRE(se evaluan en cascada)


/* 
Ejemplo de ruta que espera parámetros
  {path: 'asignaturas/:id', component: AsignaturasComponent}, 
  */
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
