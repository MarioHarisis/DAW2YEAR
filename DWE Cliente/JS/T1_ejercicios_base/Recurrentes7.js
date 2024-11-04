/* 7. Operaciones recurrentes

Pedir al usuario que introduzca por teclado dos números y 
mediante funciones mostrar el resultado de todas las operaciones 
en un cuadro de alerta

Modificar el ejercicio anterior para que una vez introducidos los 
números aparezca un cuadro de dialogo preguntando que si se quieren 
realizar las operaciones. En caso de contestar que si aparecerán por 
consola y con un espacio de 2 segundos entre cada una los resultados 
de la suma, resta, multiplicación y división. */

reiniciar = false;

do {
  const num1 = parseInt(prompt("Introduce primer número"));
  const num2 = parseInt(prompt("Introduce segundo número"));

  if (isNaN(num1) || isNaN(num2) || num1 < 1 || num2 < 1) {
    alert("Debes introducir números válidos");
    reiniciar = true;
  } else {
    if (confirm("¿Deseas realizar las operaciones?")) {
      const resultados = operaciones(num1, num2);
      for (let index = 0; index < resultados.length; index++) {
        setTimeout(() => {
          console.log(resultados[index]);
        }, 2000 * (index + 1));
      }
    }
  }
} while (reiniciar);

function operaciones(n1, n2) {
  return [n1 + n2, n1 - n2, n1 * n2, n1 / n2];
}
