import { Component, OnInit } from '@angular/core';
import { ApiService } from '../../services/api.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-list',
  standalone: false,
  templateUrl: './list.component.html',
  styleUrl: './list.component.css'
})
export class ListComponent implements OnInit{
  images: any[] = [];
  category: string = '';
  search: string = '';
  mode: 'category' | 'search' = 'category';
  
  constructor(private apiService : ApiService, private route: ActivatedRoute){}
  
  // carga las imágenes según arranca la vista
  ngOnInit(): void {
    //Called after the constructor, initializing input properties, and the first call to ngOnChanges.
    //Add 'implements OnInit' to the class.
    this.route.queryParams.subscribe(params => {
      this.category = params['category'] || 'Naturaleza';
      this.mode = 'category';
      this.loadCars();
    });
  }
  
  // resultados de la busqueda por categoria
  loadCars():void {
    this.images = [];
    this.apiService.getCarsByCategory(this.category).subscribe(response => {
      this.images = response.results;
      // compartir la lista filtrada con el servicio
      this.apiService.setFilteredList(this.images);
    })
  }
  
  // buscador de navbar por palabras
  searchImages(event :Event): void {
    event.preventDefault();
    if (!this.search.trim()) return; // comprobar que existe busqueda real
    
    this.images = []; // limpiar la lista
    this.mode = 'search'; // cambiar de modo para el titulo
    this.apiService.getImageByWords(this.search).subscribe(response => {
      this.images = response.results;
      // compartir la lista filtrada con el servicio
      this.apiService.setFilteredList(this.images);
    });
  }

}
