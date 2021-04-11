<?php

  class ServiceFile{

    private $jsonHandler;
    private $textHandler;
    private $csvHandler;
    private $Utilities;
    private $directory;

    public function __construct($ruta = "./"){
      $this->directory = "{$ruta}data";
      $this->filename = "transacciones";
      $this->jsonHandler = new JsonFileHandler($this->directory,$this->filename);
      $this->txtHandler = new SerializationFileHandler($this->directory,$this->filename);
      $this->csvHandler = new CsvFileHandler($this->directory,$this->filename);
      $this->Utilities = new Utilities();
    }

    public function GetList(){
      $transacciones = $this->jsonHandler->ReadFile();
      if($transacciones == null){
        $transacciones = array();
      }
      return (array)$transacciones;
    }

    public function GetByID($id){
      $transacciones = $this->GetList();
      $transaccion = $this->Utilities->SearchProperty($transacciones, "ID", $id);
      return ((count($transaccion) == 0) ? null : $transaccion[0]);
    }

    public function Add($item){
      $transacciones = $this->GetList();
      do {
        $not_in_list = true;
        $id = uniqid('',true);
        foreach ($transacciones as $transaccion) {
          if($id == $transaccion->ID){
            $not_in_list = false;
          }
        }
      } while ($not_in_list == false);

      $item->ID = $id;
      array_push($transacciones,$item);
      $log = new Logger("Insertar",$item);
      $log->writeAddLog();
      $this->jsonHandler->SaveFile($transacciones);
      $this->txtHandler->SaveFile($transacciones);
      $this->csvHandler->SaveFile($transacciones);
    }

    public function AddGroup($path, $name, $ext){
      $transacciones = $this->GetList();
      $groupHandler = null;
      if($ext == "json"){
        $groupHandler = new JsonFileHandler($path,$name);
      }elseif($ext == "csv"){
        $groupHandler = new CsvFileHandler($path,$name);
      }
      $content = $groupHandler->ReadAddfile($path,$name);
      foreach($content as $item){
        do {
          $not_in_list = true;
          $id = uniqid('',true);
          foreach ($transacciones as $transaccion) {
            if($id == $transaccion->ID){
              $not_in_list = false;
            }
          }
        } while ($not_in_list == false);

        date_default_timezone_set("America/Santo_Domingo");
        $fecha = date('d-m-y h:iA', time());

        $transaccion = new Transaccion(
          $fecha,
          $item->Monto,
          $item->Descripcion
        );

        $transaccion->ID = $id;
        array_push($transacciones,$transaccion);
        $log = new Logger("Insertar",$transaccion);
        $log->writeAddLog();
        $this->jsonHandler->SaveFile($transacciones);
        $this->txtHandler->SaveFile($transacciones);
        $this->csvHandler->SaveFile($transacciones);
      }
    }

    public function Edit($item){
      $transacciones = $this->GetList();
      $index = $this->Utilities->GetIndexElement($transacciones, "ID", $item->ID);
      if($index !== null){
        $lastItem = $this->GetByID($item->ID);
        $transacciones[$index] = $item;
        $log = new Logger("Editar",$item);
        $log->writeEditLog($lastItem);
        $this->jsonHandler->SaveFile($transacciones);
        $this->txtHandler->SaveFile($transacciones);
        $this->csvHandler->SaveFile($transacciones);
      }
    }

    public function Delete($id){
      $transacciones = $this->GetList();
      $index = $this->Utilities->getIndexElement($transacciones,"ID",$id);
      if($index !== null){
        unset($transacciones[$index]);
        $log = new Logger("Eliminar",$this->GetByID($id));
        $log->writeDeleteLog();
        $this->jsonHandler->SaveFile($transacciones);
        $this->txtHandler->SaveFile($transacciones);
        $this->csvHandler->SaveFile($transacciones);
      }
    }
  }

?>