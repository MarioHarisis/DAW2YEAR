/* 4. Crea un array vacío llamado baraja de tipo string. 
Mete de golpe todas las cartas de la baraja francesa con el siguiente formato:

```javascript
1C,2C,3C,4C....,JC,QC,KC
1D,2D,3D,4D....,JD,QD,KD
1R,2R,3R,4R....,JR,QR,KR
1P,2P,3P,4P....,JP,QP,KP
``` 
Una vez creado el array baraja las cartas para que se desordenen. 
Puedes utilizar alguna librería externa como por ejemplo underscore*/
let baraja = [];

function agregarCartas(palo) {
  for (let index = 1; index <= 13; index++) {
    let indexString = index.toString();

    if (index == 11) {
      indexString = "J";
    }
    if (index == 12) {
      indexString = "Q";
    }
    if (index == 13) {
      indexString = "K";
    }

    baraja.push(indexString.concat(palo));
  }
}
agregarCartas("C");
agregarCartas("D");
agregarCartas("R");
agregarCartas("P");
console.log(baraja);

let barajaMezclada = _.shuffle(baraja);
console.log(barajaMezclada);

/* 5. Continuando con el ejercicio anterior, ves sacando por consola cartas 
de la baraja cada 5 segundos. Hay que tener en cuenta que cuando una baraja 
se tiene que quitar del mazo para que no pueda volver a salir. Una vez salga 
la varaba tendrás que poner el siguiente mensaje: 

```javascript
Carta KC
Valor: 13
Palo: C

Carta 7T
Valor: 7

```  */

// Así lo hice yo
function sacarCartas() {
  if (barajaMezclada.length === 0) {
    console.log("No quedan más cartas");
    clearInterval(intervalo); // detener intervalo
    return;
  }

  // barajaMezclada disminuye su número cada vez que se ejecuta
  const carta = barajaMezclada.shift(); // lit: Removes the first element from an array and returns it.
  const valor = carta.substring(0, carta.length - 1);
  const palo = carta.substring(carta.length - 1);
  console.log(`Carta: ${carta}\n Valor: ${valor}\n Palo: ${palo}`);
}

const intervalo = setInterval(sacarCartas, 100);

// Más optimizado y sin llamar a una función(puede que prefiramos tener que llamarla en algunos casos).
/* setInterval(() => {
  if (barajaMezclada.length === 0) {
    console.log("No quedan más cartas");
    clearInterval(intervalo); // detener intervalo
    return;
  }

  const carta = barajaMezclada.shift();
  const valor = carta.substring(0, carta.length - 1);
  const palo = carta.substring(carta.length - 1);
  console.log(`Carta: ${carta}\n Valor: ${valor}\n Palo: ${palo}`);
}, 1000); */
