<?php

  class Transaccion{

    public $ID;
    public $Monto;
    public $Fecha;
    public $Descripcion;

    public function __construct($fecha, $monto, $descripcion){
      $this->Fecha = $fecha;
      $this->Monto = $monto;
      $this->Descripcion = $descripcion;
    }

  }

?>