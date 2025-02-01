let preguntas = [];
let respuestas = [];
let aciertos = [];
let seleccionadas = [];
const rowDom = document.querySelector(".row-js");
const mensaje = document.createElement("h4");
const instruccionDom = document.querySelector(".instruccion");

fetch("https://opentdb.com/api.php?amount=5&type=multiple")
  .then((response) => response.json())
  .then((data) => {
    preguntas = data.results;
    console.log(preguntas);
    mostrarPregunta();
  })
  .catch((error) => {
    console.log(error);
  });

// Generar preguntas secuencialmente con retraso
let index = 0;

function mostrarPregunta() {
  rowDom.innerHTML = "";
  if (index < preguntas.length) {
    const element = preguntas[index];

    // Crear fila para la pregunta

    /* los tres puntos '...' nos permite meter cada elemento individualmente,
        si no los pusiesemos el array quedaría [[3], 1] */
    respuestas = [...element.incorrect_answers, element.correct_answer];
    respuestas.sort(() => Math.random() - 0.5); // Barajar las respuestas
    const row = document.createElement("ul");
    row.classList = "list-group list-group-horizontal-md mt-4 respuestas-list";
    row.innerHTML = `
              <li class="list-group-item">
                <h2> ${element.category} </h2>
                <h3>${element.question}</h3>
              </li>
        `;
    rowDom.appendChild(row);

    // Crear botones para las respuestas
    respuestas.forEach((answer) => {
      const answerRow = document.createElement("ul");
      answerRow.classList =
        "list-group list-group-horizontal-md respuestas-list";
      answerRow.innerHTML = `
                <li class="list-group-item">
                      <button type="button" class="btn answer-btn">${answer}</button>
                </li>
          `;
      rowDom.appendChild(answerRow);

      // Agregar evento click al botón
      const button = answerRow.querySelector(".answer-btn");
      button.addEventListener("click", () => {
        // Comprobar la respuesta
        if (answer === element.correct_answer) {
          aciertos.push(answer);
          mostrarMensaje("¡Respuesta correcta!", "#90BE6D");
          button.style.backgroundColor = "#90BE6D";
        } else {
          mostrarMensaje("Respuesta incorrecta", "#F94144");
          button.style.backgroundColor = "#F94144";
        }

        // Almacenar la opción seleccionada
        seleccionadas.push(button.textContent);

        // Desactivar botones después de responder
        const btnToDisable = document.querySelectorAll(".btn");
        btnToDisable.forEach((element) => {
          element.disabled = true;
        });
      });
    });
    index++;
    setTimeout(mostrarPregunta, 2000); // Mostrar siguiente pregunta después de 2 segundos
  } else {
    instruccionDom.textContent = "¡Se acabó!";
    mensaje.style.color = "#FFBE0B";
    mensaje.textContent = `Has acertado ${aciertos.length} preguntas`;
    rowDom.appendChild(mensaje);

    const divBtnVerResultados = document.createElement("div");
    divBtnVerResultados.innerHTML = `
    <button type="button" class="btn btn-primary btn-resultados">Ver preguntas</button>
    `;
    rowDom.appendChild(divBtnVerResultados);

    // Listener de ver resultados
    const btnVerResultados = document.querySelector(".btn-resultados");
    btnVerResultados.addEventListener("click", () => {
      btnVerResultados.remove();
      verResultados();
    });
  }
}

// Manejo del mensaje del resultado(error/acierto)
function mostrarMensaje(texto, color) {
  mensaje.textContent = `${texto}`;
  mensaje.style.color = `${color}`;
  rowDom.appendChild(mensaje);
}

function verResultados() {
  instruccionDom.innerHTML = "";
  rowDom.innerHTML = "";

  preguntas.forEach((pregunta) => {
    const row = document.createElement("ul");
    row.classList = "list-group list-group-horizontal-md mt-4 respuestas-list";
    row.innerHTML = `
              <li class="list-group-item">
                <h2> ${pregunta.category} </h2>
                <h3>${pregunta.question}</h3>
              </li>
        `;
    rowDom.appendChild(row);

    // Obtener todas las respuestas (incluyendo la correcta)
    respuestas = [...pregunta.incorrect_answers, pregunta.correct_answer];
    respuestas.forEach((answer) => {
      const answerRow = document.createElement("ul");
      answerRow.classList =
        "list-group list-group-horizontal-md respuestas-list";

      const answerRowLi = document.createElement("li");
      answerRowLi.classList = "list-group-item mt-1";
      answerRowLi.textContent = `${answer}`;
      // Cambiar color segun respuesta
      if (answer === pregunta.correct_answer) {
        answerRow.style.backgroundColor = "#90BE6D"; // Verde para correcta
        answerRowLi.style.backgroundColor = "#90BE6D"; // Verde para correcta
      } else {
        answerRow.style.backgroundColor = "#F94144"; // Rojo para incorrecta
        answerRowLi.style.backgroundColor = "#F94144"; // Rojo para incorrecta
      }

      // Marcar las respuestas seleccionadas por el user
      seleccionadas.forEach((seleccionada) => {
        if (answer == seleccionada) {
          const seleccionadaText = document.createElement("div");
          seleccionadaText.classList = "seleccionadaText";
          seleccionadaText.textContent = "SELECCIONADA";
          answerRowLi.append(seleccionadaText);
        }
      });

      answerRow.appendChild(answerRowLi);
      rowDom.appendChild(answerRow);
    });
  });
}
