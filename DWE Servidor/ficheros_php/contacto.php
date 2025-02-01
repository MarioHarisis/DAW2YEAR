<?php

class Contacto
{
    public $nombre;
    public $telefono;
    public $email;

    public function __construct($nombre, $telefono, $email)
    {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    public function mostrarContacto()
    {
        return "<p><strong>Nombre:</strong> $this->nombre</p>
                <p><strong>Teléfono:</strong> $this->telefono</p>
                <p><strong>Email:</strong> $this->email</p>";
    }

    public function getNombre()
    {
        return $this->nombre;
    }
}
