/* 2. Crear un array vacío, luego generar 20 números al azar y guardarlos en un array. 
Una vez generados realiza las siguientes acciones:*/

const array = [];
const arrayPares = [];
let maxNum = 0;
let minNum = 100;
let sumaMedia = 0;

for (let index = 1; index <= 20; index++) {
  const random = Math.floor(Math.random() * (100 - 1 + 1)) + 1;
  array.push(random);
  sumaMedia += random;
  if (random % 2 == 0) {
    arrayPares.push(random);
  }

  if (random > maxNum) {
    maxNum = random;
  }

  if (random < minNum) {
    minNum = random;
  }
}

// - Muestra por cosola todos los numeros
console.log(array);

// - Muestra por consola los pares
console.log(arrayPares);

// - Muestra el número máximo
console.log(maxNum);

// - Muestra el número mínimo
console.log(minNum);

// - Muestra la media
console.log(sumaMedia / array.length);
