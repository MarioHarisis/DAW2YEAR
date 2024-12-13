class Banca {
  cartasBanca = [];
  cartasMezcladas = [];

  constructor() {
    this.cartasBanca = [];
    this.cartasMezcladas = this.cartasMezcladas;
  }

  generarCartas() {
    let palos = ["C", "D", "P", "T"];
    let nuevaCarta;

    for (let palo of palos) {
      for (let index = 1; index <= 13; index++) {
        switch (index) {
          case 11:
            nuevaCarta = new Carta(`J${palo}`);
            break;
          case 12:
            nuevaCarta = new Carta(`Q${palo}`);
            break;
          case 13:
            nuevaCarta = new Carta(`K${palo}`);
            break;
          default:
            nuevaCarta = new Carta(`${index}${palo}`);
            break;
        }
        this.cartasBanca.push(nuevaCarta);
      }
    }
    // Baraja que se utiliza en el juego
    this.cartasMezcladas = _.shuffle(this.cartasBanca);
    return this.cartasMezcladas;
  }
}
