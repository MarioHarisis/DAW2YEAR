import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './components/home/home.component';
import { ErrorComponent } from './components/error/error.component';
import { ListComponent } from './components/list/list.component';
import { DetailComponent } from './components/detail/detail.component';

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
  {
    path: 'list',
    component: ListComponent,
  },
  {
    path: 'detail/:id',
    component: DetailComponent
  },
  {
    path: 'error',
    component: ErrorComponent,
  },
  {
    path: '**',
    redirectTo: 'error',
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
