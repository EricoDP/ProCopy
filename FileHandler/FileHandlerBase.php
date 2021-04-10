<?php

class FileHandlerBase
{

  protected $directory;
  protected $fileName;

  public function __construct($directory, $filename)
  {
    $this->directory = $directory;
    $this->fileName = $filename;
  }

  function CreateDirectory($path)
  {
    if (!file_exists($path)) {
      mkdir($path, 0777, true);
    }
  }
}

?>