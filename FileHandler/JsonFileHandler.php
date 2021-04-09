<?php

  class JsonFileHandler{
    
    public function SaveFile($directory,$filename,$value){
      $this->CreateDirectory($directory);
      $path = $directory . "/" . $filename . ".json";
      $serializeData = json_encode($value);
      $file = fopen($path,"w+");
      fwrite($file,$serializeData);
      fclose($file);
    }

    public function ReadFile($directory,$filename){
      $this->CreateDirectory($directory);
      $path = $directory . "/" . $filename . ".json";
      if(file_exists($path)){
        $file = fopen($path,"r");
        $content = fread($file,filesize($path));
        fclose($file);
        return json_decode($content);
      }else{
        return null;
      }
    }

    public function CreateDirectory($path){
      if(!file_exists($path)){
        mkdir($path,0777,true);
      }
    }

  }

?>