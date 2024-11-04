/* 2. FizzBuzz (pregunta recurrente en entrevistas de js)

Escribe un programa que use console.log para imprimir todos los números de 1 a 100, con dos excepciones:

- Para números divisibles por 3, imprime "Fizz" en lugar del número
- Para los números divisibles por 5 (y no 3), imprime "Buzz" en su lugar.
  Cuando tengas eso funcionando, modifica tu programa para imprimir " FizzBuzz", 
  para números que sean divisibles entre 3 y 5 (y aún imprimir "Fizz" o "Buzz" 
  para números divisibles por solo uno de ellos). */

for (let index = 1; index <= 100; index++) {
  if (index % 3 == 0) {
    console.log(index + " Fizz");
  }
  if (index % 5 == 0) {
    console.log(index + " Buzz");
  }
  if (index % 3 == 0 && index % 5 == 0) {
    console.log(index + " FizzBuzz");
  }
}
