<?php

  class JsonFileHandler extends FileHandlerBase implements iFileHandler{
    
    public function __construct($directory, $filename){
      parent::__construct($directory, $filename);
    }

    public function SaveFile($value){
      $this->CreateDirectory($this->directory);
      $path = $this->directory . "/" . $this->filename . ".json";
      $serializeData = json_encode($value);
      $file = fopen($path,"w+");
      fwrite($file,$serializeData);
      fclose($file);
    }

    public function ReadFile(){
      $this->CreateDirectory($this->directory);
      $path = $this->directory . "/" . $this->filename . ".json";
      if(file_exists($path)){
        $file = fopen($path,"r");
        $content = fread($file,filesize($path));
        fclose($file);
        return json_decode($content);
      }else{
        return null;
      }
    }

    public function ReadAddfile($direct, $name){
      $path = $this->directory . "/" . $this->filename;
      $record = array();
      if(file_exists($path)){
        $record = json_decode(file_get_contents($path));
      }
      return $record;
    }
  }

?>