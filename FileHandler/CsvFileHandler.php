<?php

  class CsvFileHandler extends FileHandlerBase implements iFileHandler{
    
    public function __construct($directory, $filename){
      parent::__construct($directory, $filename);
    }

    public function SaveFile($value){
      $this->CreateDirectory($this->directory);
      $path = $this->directory . "/" . $this->filename . ".csv";
      array_unshift($value,["ID","Monto","Fecha","Descripcion"]);
      $file = fopen($path,"w");
      foreach ($value as $registro) {
        $serializeData = (array) $registro;
        fputcsv($file,$serializeData);
      }
      fclose($file);
    }

    public function ReadFile(){
      $this->CreateDirectory($this->directory);
      $path = $this->directory . "/" . $this->filename . ".csv";
      $record = array();
      if(file_exists($path)){
        $file = fopen($path,"r");
        if($file !== false){
          while (($d = fgetcsv($file,0,',')) !== false) {
            $a = count($d);
            $data = new Transaccion($d[$a-3],$d[$a-2],$d[$a-1]);
            if($a == 4){
              $data->ID = $d[$a-4];
            }
            array_push($record,$data);
          }
          array_shift($record);
        }
      }
      return $record;
    }

    public function ReadAddfile($direct, $name){
      $path = $this->directory . "/" . $this->filename;
      $record = array();
      if(file_exists($path)){
        $file = fopen($path,"r");
        if($file !== false){
          while (($d = fgetcsv($file,0,',')) !== false) {
            $a = count($d);
            $data = new Transaccion(null,$d[$a-2],$d[$a-1]);
            array_push($record,$data);
          }
          array_shift($record);
        }
      }
      return $record;
    }
  }

?>