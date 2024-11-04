/* 3. Crea un array con los siguientes valores: 

```javascript
const ages = [19, 22, 19, 24, 20, 25, 26, 24, 25, 24]
```

Una vez tengas introducidos todos los valores realiza las siguientes tareas: 

- Ordena el array y obten el valor máximo y mínimo
- Obtén la medida de edad */

const ages = [19, 22, 19, 24, 20, 25, 26, 24, 25, 24];

let sumaMedia = 0;
let maxValue = 0;
let minValue = 27;

for (const edad of ages) {
  sumaMedia += edad;

  if (edad > maxValue) {
    maxValue = edad;
  }

  if (edad < minValue) {
    minValue = edad;
  }
}

// - Obtén la medida de edad
console.log(sumaMedia / ages.length);

console.log(maxValue);
console.log(minValue);

// Ordenar en orden ascendente
ages.sort((a, b) => a - b);
/* En la función de comparación a - b, si a es menor que b, 
devuelve un número negativo, lo que indica que a debe ir antes que b. 
Si a es mayor que b, devuelve un número positivo, indicando que b debe 
ir antes que a. Si son iguales, devuelve 0, y el orden no cambia. */

console.log(ages);
