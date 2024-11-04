/* 4. Comparación de fechas:

Realiza un programa que pida por prompt el día, mes y año de tu cumpleaños. 
Indica cuantos días han pasado desde tu cumpleaños hasta el día de hoy */

let fechaNacimiento = new Date();
fechaNacimiento.setFullYear(
  parseInt(prompt("Introduce tu año de nacimiento")),
  parseInt(prompt("Introduce tu mes de nacimiento") - 1),
  parseInt(prompt("Introduce el día de tu nacimiento"))
);
console.log(fechaNacimiento);

let diferenciaMs = new Date() - fechaNacimiento; // calucla en Ms
let totalDias = Math.floor(diferenciaMs / (1000 * 60 * 60 * 24));
console.log(`La diferencia entre las fechas es de ${totalDias} días.`); // pasar a días
