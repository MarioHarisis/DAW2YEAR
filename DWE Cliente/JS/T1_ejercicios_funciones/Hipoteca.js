const formulario = document.querySelector(".formulario");
const tablaBody = document.querySelector("#tabla-body");
const precio = document.querySelector("#precio");
const years = document.querySelector("#years");
const interes = document.querySelector("#interes");

formulario.addEventListener("submit", function (event) {
  event.preventDefault();
  linea_amortizacion(years.value, precio.value, interes.value);
});

function linea_amortizacion(years, precio, interes) {
  // Convertir a números
  precio = parseFloat(precio);
  years = parseInt(years);
  interes = parseFloat(interes) / 100; // Convertir a decimal

  const cuotaAnual = (precio * interes) / (1 - Math.pow(1 + interes, -years));
  const cuotaMensual = cuotaAnual / 12;
  let saldoRestante = precio;
  let totalIntereses = 0;

  for (let index = 1; index <= years; index++) {
    // Creación de elementos
    const fila = document.createElement("tr");
    const celdaYear = document.createElement("td");
    const celdaCuota = document.createElement("td");
    const celdaAmortizado = document.createElement("td");
    const celdaInteres = document.createElement("td");
    const celdaPendiente = document.createElement("td");

    // Calculos
    const interesAnual = saldoRestante * interes;
    const amortizacionCapital = cuotaAnual - interesAnual; // Parte de la cuota que va a amortizar el capital
    saldoRestante -= amortizacionCapital;
    totalIntereses += interesAnual;

    celdaYear.textContent = `${index}`; // Año
    celdaCuota.textContent = `${cuotaAnual.toFixed(2)}€`; // Cuota anual
    celdaAmortizado.textContent = `${amortizacionCapital.toFixed(2)}€`; // Saldo restante
    celdaInteres.textContent = `${interesAnual.toFixed(2)}`; // Interés anual
    celdaPendiente.textContent = `${saldoRestante.toFixed(2)}€`; // Saldo pendiente

    fila.appendChild(celdaYear);
    fila.appendChild(celdaCuota);
    fila.appendChild(celdaAmortizado);
    fila.appendChild(celdaInteres);
    fila.appendChild(celdaPendiente);

    tablaBody.appendChild(fila);
  }

  const resumen = document.createElement("div");
  const totalPagado = precio + totalIntereses;
  const mensualidades = parseInt(years * 12);
  resumen.textContent = `Pagarás un total de ${totalPagado.toFixed(
    2
  )}€ ya con intereses, en ${mensualidades} mensualidades con una cuota de ${cuotaMensual.toFixed(
    2
  )}€/mes`;
  formulario.appendChild(resumen);
}
