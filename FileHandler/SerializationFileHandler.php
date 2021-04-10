<?php

  class SerializationFileHandler extends FileHandlerBase implements iFileHandler{
    
    public function __construct($directory, $filename){
      parent::__construct($directory, $filename);
    }

    public function SaveFile($value){
      $this->CreateDirectory($this->directory);
      $path = $this->directory . "/" . $this->filename . ".txt";
      $serializeData = serialize($value);
      $file = fopen($path,"w+");
      fwrite($file,$serializeData);
      fclose($file);
    }

    public function ReadFile(){
      $this->CreateDirectory($this->directory);
      $path = $this->directory . "/" . $this->filename . ".txt";
      if(file_exists($path)){
        $file = fopen($path,"r");
        $content = fread($file,filesize($path));
        fclose($file);
        return unserialize($content);
      }else{
        return null;
      }
    }
  }

?>