<?php
  require_once '../FileHandler/JsonFileHandler.php';
  require_once './serviceFile.php';
  require_once '../helpers/utilities.php';
  require_once '../models/transaccion.php';

  $service = new ServiceFile("../");

  if(isset($_POST["Monto"]) && isset($_POST["Descripcion"]) && isset($_POST["Fecha"])){

    $transaccion = new Transaccion(
      $_POST["Monto"],
      $_POST["Fecha"],
      $_POST["Descripcion"]
    );

    $service->Add($transaccion);
    header("Location: ../index.php");

  }

?>