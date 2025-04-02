import { Component } from '@angular/core';
import { DataService } from '../../services/data.service';
import { Post } from '../../model/post';

@Component({
  selector: 'app-filter',
  standalone: false,
  templateUrl: './filter.component.html',
  styleUrl: './filter.component.css',
})
export class FilterComponent {
  seleccionTag: string = ''; // obtener filtro seleccionado
  posts: Post[] = []; // lista de posts

  constructor(private dataService: DataService) {}

  // accion del boton filtrar
  realizarFiltro() {
    // this.seleccionTag
    console.log(this.seleccionTag);
    this.dataService.getAllPostTagURL(this.seleccionTag).subscribe((data) => {
      
      // obtenemos todos los posts con el tag 'seleccionTag' para almacenarlos en la lista
      this.posts = data.posts;
    });
  }
}
