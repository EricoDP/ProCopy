<?php

require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/SerializationFileHandler.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../FileHandler/CsvFileHandler.php';
require_once '../FileHandler/Logger.php';

require_once './serviceFile.php';
require_once '../helpers/utilities.php';
require_once '../models/transaccion.php';

  $service = new ServiceFile("../");

  if(isset($_GET["id"])){
    $service->Delete($_GET["id"]);
  }

  header("Location: ../index.php");
  exit();

?>