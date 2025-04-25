import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private apiUrl = 'https://api.unsplash.com/search/photos'; // direccion de la API
  private filteredList: any[] = [];
  private detail?: Object;

  // Inyectamos el servicio HttpClient para poder usarlo dentro del servicio.
  constructor(private http: HttpClient) {}

  // Método que acepta una categoría (ej. “lujo”, “clásicos”) como parámetro.
  // Devuelve un Observable<any>: la respuesta de la API.
  getCarsByCategory(category: string): Observable<any> {

    // HttpParams construye los parámetros que irán en la URL.
    const params = new HttpParams()
      .set('query', `${category}`) // lo que buscamos (la categoría + cars).
      .set('client_id', environment.unsplashAccessKey) // clave de Unsplash para autenticarte
      .set('per_page', '30'); // cuántas fotos cogemos (20).
      //.set('order_by', 'relevant') se establece por default así

      // Hace una petición GET a la API de Unsplash con los parámetros.
      // Retorna un Observable que el componente podrá suscribirse para recibir los datos.
    return this.http.get(this.apiUrl, { params });
  }

  // utilizamos para el buscador del navbar
  getImageByWords(words : string): Observable<any>{

    const params = new HttpParams()
    .set('query', `${words}`)
    .set('client_id', environment.unsplashAccessKey)
    .set('per_page', '30');

    return this.http.get(this.apiUrl, {params});
  }
  
  setFilteredList(data: any[]) {
    this.filteredList = data;
  }

  getFilteredList(id : string): any | undefined {
    // devolvemos el id buscandolo en la lista guardada desde la busqueda o la categoria
    this.detail = this.filteredList.find(img => img.id == id);
    return this.detail;
  }

  // devolver imagen por ID
  getImageById(id : string): Observable<any>{
    const url = `https://api.unsplash.com/photos/${id}?client_id=${environment.unsplashAccessKey}`;
    return this.http.get(url);
  }

}
