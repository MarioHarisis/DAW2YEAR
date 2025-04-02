import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './components/home/home.component';
import { DetailComponent } from './components/detail/detail.component';
import { ListComponent } from './components/list/list.component';
import { ErrorComponent } from './components/error/error.component';
import { FilterComponent } from './components/filter/filter.component';

/* http://localhost/home */
const routes: Routes = [
  {
    path: '',
    redirectTo: 'home',
    pathMatch: 'full',
  },
  {
    path: 'home',
    component: HomeComponent,
  },
  // este path admite/espera un parametro
  {
    path: 'detail/:id',
    component: DetailComponent,
  },
  {
    path: 'list',
    component: ListComponent,
  },
  {
    path: 'error',
    component: ErrorComponent,
  },
  {
    path: 'filter',
    component: FilterComponent,
  },
  {
    path: '**',
    redirectTo: 'error',
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
