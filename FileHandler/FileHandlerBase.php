<?php

class FileHandlerBase
{

  protected $directory;
  protected $filename;

  public function __construct($directory, $filename)
  {
    $this->directory = $directory;
    $this->filename = $filename;
  }

  function CreateDirectory($path)
  {
    if (!file_exists($path)) {
      mkdir($path, 0777, true);
    }
  }
}

?>