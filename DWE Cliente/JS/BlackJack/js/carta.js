class Carta {
  img;
  valor;

  constructor(representacion) {
    representacion.toUpperCase();
    this.img = `${representacion}.png`;
    this.valor = representacion.substring(0, representacion.length - 1);

    // Asignación de VALOR a las cartas para poder sumarlas
    switch (this.valor) {
      case "J":
        this.valor = 11;
        break;

      case "Q":
        this.valor = 12;
        break;
      case "K":
        this.valor = 13;
        break;
      default:
        this.valor = parseInt(this.valor);
        break;
    }
  }
}
