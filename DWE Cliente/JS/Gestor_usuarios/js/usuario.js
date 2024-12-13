class Usuario {
  imagen;
  nombre;
  apellido;
  telefono;
  genero;
  departamento;
  vip;
  vipImage;

  constructor(nombre, apellido, telefono, genero, departamento, vip) {
    this.nombre = nombre;
    this.apellido = apellido;
    this.telefono = telefono;
    this.genero = genero;
    this.departamento = departamento;
    this.vip = vip;
    // Asinación img según VIP
    if (vip == true) {
      this.vipImage = "https://cdn-icons-png.flaticon.com/512/276/276020.png";
    } else {
      this.vipImage =
        "https://uxwing.com/wp-content/themes/uxwing/download/checkmark-cross/cross-icon.png";
    }
  }
}
