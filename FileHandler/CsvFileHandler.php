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
      return null;
    }
  }

?>