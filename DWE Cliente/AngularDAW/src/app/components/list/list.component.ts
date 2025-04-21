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
  cars?: any [];
  category: string = '';

constructor(private apiService : ApiService, private route: ActivatedRoute){}

ngOnInit(): void {
  //Called after the constructor, initializing input properties, and the first call to ngOnChanges.
  //Add 'implements OnInit' to the class.
  this.route.queryParams.subscribe(params => {
    this.category = params['category'] || 'cars';
    this.loadCars();
  });
  
}

loadCars():void {
  this.apiService.getCarsByCategory(this.category).subscribe(response => {
    console.log('Respuesta completa de la API:', response);
    this.cars = response.results;
  })
}
}
