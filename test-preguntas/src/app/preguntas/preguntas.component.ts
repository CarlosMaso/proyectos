import { Component } from '@angular/core';

@Component({
  selector: 'app-preguntas',
  templateUrl: './preguntas.component.html',
  styleUrls: ['./preguntas.component.css']
})
export class PreguntasComponent {

  pregunta1:string= '¿Quien es el creador de esta app web?';
  pregunta2:string= '¿Como se llama el perro del programador de esta app?';
  pregunta3:string= '¿Cuantos años tiene el programador de esta app?';

  p1:boolean=false;
  p2:boolean=false;
  p3:boolean=false;

  edad: number;
  perro: string;
  nombre: string;

  constructor(){
    this.edad=29;
    this.perro="Stark";
    this.nombre="Carlos";
  }

  ngOnInit(): void{
    console.log(this.nombre);
  }

}
