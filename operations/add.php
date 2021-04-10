<?php
  require_once '../FileHandler/IFileHandler.php';
  require_once '../FileHandler/FileHandlerBase.php';
  require_once '../FileHandler/SerializationFileHandler.php';
  require_once '../FileHandler/JsonFileHandler.php';
  
  require_once './serviceFile.php';
  require_once '../helpers/utilities.php';
  require_once '../models/transaccion.php';

  $service = new ServiceFile("../");

  if(isset($_POST["Monto"]) && isset($_POST["Descripcion"])){

    $d = getdate();
    $fecha = str_pad($d["mday"], 2, "0", STR_PAD_LEFT) . "-" . str_pad($d["mon"], 2, "0", STR_PAD_LEFT) . "-" . $d["year"];
    $hora = $d["hours"] . ":" . $d["minutes"] . ":" . $d["seconds"];

    $transaccion = new Transaccion(
      $_POST["Monto"],
      $fecha . " " . $hora,
      $_POST["Descripcion"]
    );

    $service->Add($transaccion);
    header("Location: ../index.php");

  }

?>