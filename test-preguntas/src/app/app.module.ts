import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms'; // Importa FormsModule desde @angular/forms

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { PreguntasComponent } from './preguntas/preguntas.component';

@NgModule({
  declarations: [
    AppComponent,
    PreguntasComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule // Agrega FormsModule aquí en la sección de imports
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
