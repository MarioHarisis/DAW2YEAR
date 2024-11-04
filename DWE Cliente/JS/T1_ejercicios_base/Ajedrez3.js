/* 3. Tablero de ajedrez

Escribe un programa que cree un string que represente un tabledo de 8 × 8, 
usando caracteres de nueva línea para separar las líneas. En cada posición 
del tabledo hay un espacio o un carácter "#". Los caracteres deberían de 
formar un tablero de ajedrez.

```
# # # #
 # # # #
# # # #
 # # # #
# # # #
 # # # #
# # # #
 # # # #
``` */

let tablero = "";

for (let fila = 1; fila <= 8; fila++) {
  for (let col = 0; col < 8; col++) {
    if ((fila + col) % 2 === 0) {
      tablero += "#";
    } else {
      tablero += " ";
    }
  }
  tablero += "\n";
}
console.log(tablero);
