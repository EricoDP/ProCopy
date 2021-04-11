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

  if(isset($_POST["Monto"]) && isset($_POST["Descripcion"])){

    date_default_timezone_set("America/Santo_Domingo");
    $fecha = date('d-m-y h:iA', time());

    $transaccion = new Transaccion(
      $_POST["Monto"],
      $fecha,
      $_POST["Descripcion"]
    );

    $service->Add($transaccion);
    header("Location: ../index.php");

  }
