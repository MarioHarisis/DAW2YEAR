const jugador = new Jugador(prompt("Introduce tu nombre: "));
let cuentaJugador = 0;
let cuentaBanca = 0;
let contador = 0;
let pierdeJugador = false;
let ganador = "";
let retirarse = false;

// Mensaje inicial
const mensajeWrapper = document.querySelector("#mensajeWrapper");
mensajeWrapper.innerHTML = `
    <div class="mensajeInicial">
      <h1>¡Bienvenido a BlackJack 21${" " + jugador.nombre}!</h1>
      <p>Apuesta siempre con precaución +18.</p>
      <button type="button" class="btn btn-success mt-3" id="btn-iniciar">Iniciar juego</button>
    </div>
    `;

// Se inicia el juego
const btnIniciar = document.querySelector("#btn-iniciar");
btnIniciar.addEventListener("click", function () {
  mensajeWrapper.remove();

  // Aparecen las bancas
  const bancaContainer = document.querySelector("#banca-container");
  const jugadorContainer = document.querySelector("#jugador-container");
  const banca = new Banca();
  bancaContainer.hidden = false;
  jugadorContainer.hidden = false;

  // Creación para mostrar puntajes
  const bancaPuntaje = document.createElement("div");
  bancaPuntaje.id = "banca-puntaje";
  bancaPuntaje.innerHTML = `<h3>Puntos de la banca: 0</h3>`;
  document.body.appendChild(bancaPuntaje); // Añadido al final del contenedor

  // Puntaje del jugador
  const jugadorPuntaje = document.createElement("div");
  jugadorPuntaje.id = "jugador-puntaje";
  jugadorPuntaje.innerHTML = `<h3>Puntos del jugador: 0</h3>`;
  document.body.appendChild(jugadorPuntaje);

  // Baraja con la que se jugará
  const cartasMezcladas = banca.generarCartas();

  /**  Crear contenedor para los botones **/
  const botonesContainer = document.createElement("div");
  botonesContainer.id = "botones-container";

  // Crear botón Sacar Carta
  const btnSacarCarta = document.createElement("button");
  btnSacarCarta.id = "btn-sacarCarta";
  btnSacarCarta.className = "btn btn-success";
  btnSacarCarta.textContent = "Repartir cartas";

  // Crear botón Retirarse
  const btnRetirarse = document.createElement("button");
  btnRetirarse.id = "btn-retirarse";
  btnRetirarse.className = "btn btn-danger";
  btnRetirarse.textContent = "Retirarse";

  // Añadir botones al contenedor
  botonesContainer.appendChild(btnSacarCarta);
  botonesContainer.appendChild(btnRetirarse);

  // Añadir el contenedor al body o al lugar que desees
  document.body.appendChild(botonesContainer);

  // Retirarse
  btnRetirarse.addEventListener("click", function () {
    btnRetirarse.disabled = true;
    btnSacarCarta.disabled = true;
    turnoBanca();
  });

  // Cartas de cada paret
  banca.cartasBanca = [];
  jugador.cartasJugador = [];

  btnSacarCarta.addEventListener("click", function () {
    if (contador === 0) {
      // Jugador saca las dos primeras cartas
      jugador.cartasJugador.push(
        sacarCarta(cartasMezcladas, jugadorContainer),
        sacarCarta(cartasMezcladas, jugadorContainer)
      );
      contador = 2;
      btnSacarCarta.textContent = " Pedir";
      // Banca saca la primera carta
      banca.cartasBanca.push(sacarCarta(cartasMezcladas, bancaContainer));
    } else {
      // Turno normal
      jugador.cartasJugador.push(sacarCarta(cartasMezcladas, jugadorContainer));
      if (cuentaBanca < 17) {
        // Banca saca otra carta solo cuando la banca tenga menos de 17
        banca.cartasBanca.push(sacarCarta(cartasMezcladas, bancaContainer));
      }
      contador++;
    }

    mostrarPuntajes();

    // Verificar si la banca ha superado 21 puntos después de cada carta
    if (cuentaBanca > 21) {
      ganador = "el jugador";
      gameOver();
    }

    if (cuentaJugador >= 21) {
      turnoBanca();
    }
  });

  // Saca una carta y la agrega a un container
  function sacarCarta(baraja, container) {
    const cartaSacada = baraja.pop();
    const cartaDiv = document.createElement("div");
    cartaDiv.innerHTML = `
                  <div class="card" style="width: 15rem;">
                    <img src="/images/${cartaSacada.img}" class="card-img-top" alt="">
                  </div>
                  `;
    container.appendChild(cartaDiv);
    return cartaSacada;
  }

  // Función para manejar el turno de la banca cuando el jugador se retira
  function turnoBanca() {
    while (cuentaBanca < 17) {
      // La banca sigue sacando cartas hasta tener al menos 17 puntos
      const nuevaCarta = sacarCarta(cartasMezcladas, bancaContainer);
      banca.cartasBanca.push(nuevaCarta);
      cuentaBanca += nuevaCarta.valor;
    }

    // Mostrar resultado final
    mostrarPuntajes();
    determinarGanador();
    gameOver();
  }
  // Cuenta los puntos y los muestra
  function mostrarPuntajes() {
    // Calcular puntos del jugador
    cuentaJugador = 0;
    for (let i = 0; i < jugador.cartasJugador.length; i++) {
      cuentaJugador += jugador.cartasJugador[i].valor;
    }

    // Calcular puntos de la banca
    cuentaBanca = 0;
    for (let i = 0; i < banca.cartasBanca.length; i++) {
      cuentaBanca += banca.cartasBanca[i].valor;
    }

    // Actualizar puntajes en el DOM
    document.querySelector(
      "#jugador-puntaje"
    ).innerHTML = `<h3>Puntos del jugador: ${cuentaJugador}</h3>`;
    document.querySelector(
      "#banca-puntaje"
    ).innerHTML = `<h3>Puntos de la banca: ${cuentaBanca}</h3>`;
  }

  // Condiciones a cumplir por el ganador
  function determinarGanador() {
    // Si el jugador supera 21, pierde
    if (cuentaJugador > 21 && cuentaBanca > 21) {
      ganador = "nadie, empate"; // Ambos superan 21, empate
    } else if (cuentaJugador > 21) {
      ganador = "la banca"; // El jugador pierde si pasa de 21
    } else if (cuentaBanca > 21) {
      ganador = "el jugador"; // La banca pierde si pasa de 21
    }
    // Si ninguno pasa de 21, comparamos los puntajes
    else if (cuentaJugador > cuentaBanca) {
      ganador = "el jugador"; // El jugador gana si tiene más puntos
    } else if (cuentaJugador < cuentaBanca) {
      ganador = "la banca"; // La banca gana si tiene más puntos
    } else {
      ganador = "nadie, empate"; // Si ambos tienen el mismo puntaje, empate
    }
  }

  // Genera el mensaje final
  function gameOver() {
    // Deshabilitar los botones del jugador y quitar puntajes
    btnSacarCarta.disabled = true;
    btnRetirarse.disabled = true;
    jugadorPuntaje.remove();
    bancaPuntaje.remove();
    // Creación mensaje Game Over
    const gameOver = document.createElement("div");
    gameOver.id = "game-over-container";
    gameOver.innerHTML = `
    <div class="game-over-content">
      <h1 class="display-3">GAME OVER</h1>
      <h2 class="display-5">Gana: ${ganador}</h2>
      <h2 class="display-5">Banca: ${cuentaBanca}</h2>
      <h2 class="display-5">Jugador: ${cuentaJugador}</h2>
      <button id="btn-reiniciar" class="btn btn-warning mt-3">Reiniciar Partida</button>
    </div>
    `;
    body.appendChild(gameOver);

    // Botón reiniciar
    document
      .getElementById("btn-reiniciar")
      .addEventListener("click", function () {
        location.reload();
      });
  }
});
