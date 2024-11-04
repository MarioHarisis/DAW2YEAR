/* 1. Operaciones funciones 

Pedir al usuario que introduzca por teclado dos números y 
mediante funciones mostrar el resultado de todas las operaciones 
en un cuadro de alerta */
/* 
2. Modifica el ejercicio anterior para que en el caso de no introducir 
un sengundo parámetros, el valor por defecto que tomará el segundo 
operadores será de 0 */
/* 
3. Modifica el ejercicio anterior para que todas las funciones pidan 
por parámetros dos elementos. En el caso de que pase 1 o más de dos 
parámetros la ejecución saltará un error de excepción */

alert(
  operaciones(
    parseInt(prompt("Introduce primer número")),
    parseInt(prompt("Introduce segundo número"))
  )
);

function operaciones(n1 = 0, n2 = 0) {
  if (isNaN(n1) || isNaN(n2) || n1 === 0 || n2 === 0) {
    return "No se puede operar con estos valores";
  } else {
    return [n1 + n2, n1 - n2, n1 * n2, n1 / n2];
  }
}
