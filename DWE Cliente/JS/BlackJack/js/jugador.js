class Jugador {
  nombre;
  cartasJugador = [];

  constructor(nombre) {
    if (nombre === null || nombre.trim() === "") {
      this.nombre = ", jugarás como invitado";
    } else {
      this.nombre = nombre;
    }
  }
}
