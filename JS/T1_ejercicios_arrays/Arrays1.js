// 1. Dado el array = [1,2,3,4,5,6,7,8,9,10]

// - Iterar por todos los elementos dentro de un array utilizando while y mostrarlos en pantalla.
const array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let i = 0;

console.log("Impresion con while");
while (i < array.length) {
  console.log(array[i]);
  i++;
}

// - Iterar por todos los elementos dentro de un array utilizando for y mostrarlos en pantalla.
console.log("Impresion con for");
for (let index = 0; index < array.length; index++) {
  console.log(array[index]);
}

// - Iterar por todos los elementos dentro de un array utilizando .forEach y mostrarlos en pantalla.
console.log("Impresión con forEach");
array.forEach((item) => console.log(item));

// - Mostrar todos los elementos dentro de un array sumándole uno a cada uno.
console.log("Elementos +1");
array.forEach((item) => console.log(item + 1));

// - Calcular la media de todos los elementos del array
let total = 0;
for (const item of array) {
  total += item;
}
const media = total / array.length;
console.log(`Calcular media: ${media.toFixed(2)}`);
