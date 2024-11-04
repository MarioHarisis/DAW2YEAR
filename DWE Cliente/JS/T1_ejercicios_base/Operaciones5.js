/* 5. Operaciones

Pedir dos números por teclado y mostrar en una alerta todos las 
operaciones posibles para dichos números (suma, resta, multiplicación y división). 
Adicionalmente el programa hará lo siguiente:

- si se introduce números menores que 0 o letras que salte una alerta indicando el 
error y el programa parará

- tras mostrar todas las operaciones se pedirá confirmación al usuario para que indique
 si quiere continuar realizando operaciones: en caso positivo el programa volverá a empezar. 
 En caso negativo el programa parará

- si se detecta que alguna de las operaciones es negativa el programa parará tras realizar 
todas las operaciones de los números */
reiniciar = true;

do {
  let numeros = [
    parseInt(prompt("introduce el primer numero:")),
    parseInt(prompt("introduce el segundo numero")),
  ];

  if ((numeros[0] || numeros[1]) < 0 || isNaN(numeros[0] || numeros[1])) {
    alert("Debes introducir un número correcto");
  } else {
    const operaciones = [
      numeros[0] + numeros[1],
      numeros[0] - numeros[1],
      numeros[0] / numeros[1],
      numeros[0] * numeros[1],
    ];

    for (const item of operaciones) {
      if (item < 0) {
        alert("Una operación resultó negativa");
        reiniciar = false;
        break;
      }
    }

    alert(
      "suma: " +
        operaciones[0] +
        "\n" +
        "resta: " +
        operaciones[1] +
        "\n" +
        "division: " +
        operaciones[2] +
        "\n" +
        "multiplicacion: " +
        operaciones[3]
    );

    if (reiniciar) {
      if (confirm("¿Deseas hacer nuevas operaciones?") == false) {
        reiniciar = false;
      }
    }
  }
} while (reiniciar);
