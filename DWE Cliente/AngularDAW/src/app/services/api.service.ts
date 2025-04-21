import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private apiUrl = 'https://api.unsplash.com/search/photos'; // direccion de la API

  // Inyectamos el servicio HttpClient para poder usarlo dentro del servicio.
  constructor(private http: HttpClient) {}

  // Método que acepta una categoría (ej. “lujo”, “clásicos”) como parámetro.
  // Devuelve un Observable<any>: la respuesta de la API.
  getCarsByCategory(category: string): Observable<any> {

    // HttpParams construye los parámetros que irán en la URL.
    const params = new HttpParams()
      .set('query', `${category} cars`) // lo que buscamos (la categoría + cars).
      .set('client_id', environment.unsplashAccessKey) // clave de Unsplash para autenticarte
      .set('per_page', '30'); // cuántas fotos cogemos (20).

      // Hace una petición GET a la API de Unsplash con los parámetros.
      // Retorna un Observable que el componente podrá suscribirse para recibir los datos.
    return this.http.get(this.apiUrl, { params });
  }
}
