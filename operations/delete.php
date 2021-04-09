<?php

  require_once '../helpers/utilities.php';
  require_once '../FileHandler/JsonFileHandler.php';
  require_once './serviceFile.php';

  $service = new ServiceFile("../");

  if(isset($_GET["id"])){
    $service->Delete($_GET["id"]);
  }

  header("Location: ../index.php");
  exit();

?>