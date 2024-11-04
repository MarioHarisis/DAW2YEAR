/* 1. Piramide

Escriba un script que pedido por consola (prompt un número), 
represente por consola la siguiente figura con el número de filas introducido en 
el prompt.En el caso de no introducir un número o que sea menor que 0 saltará un aviso por 
consola y dará la posibilidad de repetir el proceso:

```
Cuantas filas quieres que aparezca: 7

+
++
+++
++++
+++++
++++++
+++++++
``` */

do {
  reintentar = false;
  numeroUser = parseInt(prompt("Introduce un número del 1 al 10"));

  if (isNaN(numeroUser) || numeroUser > 10 || numeroUser < 1) {
    alert("El número debe encontrarse entre 1 y 10");
    reintentar = confirm("¿Quieres reintentar?");
  } else {
    console.log("Número introducido correctamente");

    for (let index = 1; index <= numeroUser; index++) {
      console.log("+".repeat(index) + "\n");
    }
  }
} while (numeroUser < 0 || reintentar == true);
