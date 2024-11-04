/* 6. Frases

Pedir al usuario que introduzca una frase por teclado. T
ras meter la frase se ejecutará la siguiente funcionalidad:

- Si la frase tiene menos de 10 letras, se volverá a pedir nuevamente
- Si tiene más de 10 letras aparecerá una alerta con la siguiente información:

  - El dato introducido tiene:
  - X letras
  - X palabras
  - X frases */

reiniciar = false;

do {
  const frase = prompt("Introduce una frase de la menos 10 letras");

  if (frase.length < 10) {
    alert("La frase debe tener 10 letras mínimo");
    reiniciar = true;
  } else {
    const letras = frase.replace(/[\s.,]/g, "");
    console.log(letras);

    const palabras = frase
      .split(" ")
      .filter((palabra) => palabra.trim() !== "");
    console.log(palabras);

    const frases = frase.split(/[.,]/).filter((frase) => frase.trim() !== "");
    console.log(frases);

    alert(
      frase +
        "\n" +
        letras.length +
        " letras \n" +
        palabras.length +
        " palabra/s \n" +
        frases.length +
        " frase/s"
    );
  }
} while (reiniciar);
