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

  if(isset($_FILES["archivoTransaccion"]))
  {
    $file = $_FILES["archivoTransaccion"]["tmp_name"];
    $filename = explode("\\",$file)[count(explode("\\",$file))-1];
    $path = str_replace($filename,"",$file);
    $ext = strtolower(explode(".",$_FILES["archivoTransaccion"]["name"])[1]);
    if($ext == "csv" || $ext = "json"){
      $service->AddGroup($path, $filename, $ext);
    }else{
      echo '<script>alert("Debe ingresar un archivo .json o .csv")</script>';
    }
    header("Location: ../index.php");
  }

  if(isset($_POST["Monto"]) && isset($_POST["Descripcion"]))
  {
    if($_POST["Monto"] != "" && isset($_POST["Descripcion"]) != null)
    {
      date_default_timezone_set("America/Santo_Domingo");
      $fecha = date('d-m-y h:iA', time());

      $transaccion = new Transaccion(
        $fecha,
        $_POST["Monto"],
        $_POST["Descripcion"]
      );

      $service->Add($transaccion);
    }
    else{
      echo '<script>alert("Debe llenar todos los campos correctamente")</script>';
    }
    header("Location: ../index.php");
  }
