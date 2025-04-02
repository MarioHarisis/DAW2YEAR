import { Component, Input } from '@angular/core';
import { Post } from '../../model/post';

@Component({
  selector: 'app-post',
  standalone: false,
  templateUrl: './post.component.html',
  styleUrl: './post.component.css',
})

export class PostComponent {
  
  /* 
  Input() asigna a post el valor que se le pase
  (<app-post [post]="item"></app-post>, [post]="item" sería el valor que recibe)
  Por lo tanto app-post será un componente con un dato de entrada
  */
  @Input() post?: Post;
}
