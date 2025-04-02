import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { DataService } from '../../services/data.service';
import { Post } from '../../model/post';

@Component({
  selector: 'app-detail',
  standalone: false,
  templateUrl: './detail.component.html',
  styleUrl: './detail.component.css',
})
export class DetailComponent {
  post: Post | undefined = undefined; // post puede ser de tipo Post o undefined

  constructor(
    // ActivatedRoute es utilizado para acceder a los parámetros de la URL 
    // (como el id del post en la ruta).
    private router: ActivatedRoute,

    // DataService es utilizado para realizar solicitudes HTTP para obtener datos del servidor.
    private dataService: DataService
  ) {

    this.router.params.subscribe((params) => {
      // usameos metodo getPostByIdURL del service para obtener la url del post (params['id'])
      this.dataService.getPostByIdURL(params['id']).subscribe((data) => {
        // igualamos el post a los datos que recibimos desde la url
        this.post = data;
      });
    });
  }
}
