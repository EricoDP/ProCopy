<?php

  class Transaccion{

    public $ID;
    public $Monto;
    public $Fecha;
    public $Descripcion;

    public function __construct($monto, $fecha, $descripcion){
      $this->Monto = $monto;
      $this->Fecha = $fecha;
      $this->Descripcion = $descripcion;
    }

  }

?>