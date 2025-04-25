import { Component } from '@angular/core';
import { ApiService } from '../../services/api.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-detail',
  standalone: false,
  templateUrl: './detail.component.html',
  styleUrl: './detail.component.css'
})
export class DetailComponent {

  image : any;
  date : any;

  constructor(private apiService: ApiService, private router: ActivatedRoute){
    // subscribirnos a los cambios en la url
    this.router.params.subscribe((params) => {
      // subscribirnos a los cambios en la busqueda por ID
    this.apiService.getImageById(params['id']).subscribe((data)=> {
      this.image =  data;
      // asignar fecha de la publicación
      this.date = this.image.created_at.split('T')[0]; //dividir la parte que nos interesa de la fecha
      });
      console.log(this.image);
    });
  }

}
