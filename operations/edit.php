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

  $utilities = new Utilities();
  $service = new ServiceFile("../");

  $transaccion = null;
  if(isset($_GET["id"])){
    $transaccion = $service->GetByID($_GET["id"]);
  }

  if(isset($_POST["ID"]) && isset($_POST["Monto"]) && isset($_POST["Descripcion"]) && isset($_POST["Fecha"])){

    $transaccion = new Transaccion(
      $_POST["Monto"],
      $_POST["Fecha"],
      $_POST["Descripcion"]
    ); 
    
    $transaccion->ID = $_POST["ID"];
    $service->Edit($transaccion);
    header("Location: ../index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Bootstrap-->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <script src="../assets/js/bootstrap.min.js"></script>
  <title>Registro de transaccions</title>
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Top navbar</a>
    </div>
  </nav>

  <!--Edit Content Begin-->

  <?php if($transaccion == null) :?>
    <h3 class="w-100 text-center">No hay registro de esa transacion</h3>
  <?php else: ?>
    <main class="">
      <div class="container bg-dark text-light rounded-top py-1">
        <h5 class="text-center" id="offcanvasExampleLabel">Editar Transaccion</h5>
      </div>
      <div class="container bg-white py-3 px-5 rounded-bottom">
        <div class="fw-bold">Formulario de Transacciones</div>
        <hr class="mt-0">
        <form class="ms-1" action="./edit.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="ID" value="<?= $transaccion->ID ?>">
          <input type="hidden" name="Fecha" value="<?= $transaccion->Fecha ?>">
          <div class="modal-body">
            <div class="ms-1">
              <div class="mb-3">
                <label for="txtMonto" class="form-label">Monto</label>
                <div class="input-group mb-3">
                  <span class="input-group-text">$</span>
                  <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="Monto" value="<?= $transaccion->Monto ?>">
                  <span class="input-group-text">.00</span>
                </div>
              </div>
              <div class="md-3">
                <label for="txtDescripcion" class="form-label">Descripcion</label>
                <textarea class="form-control" name="Descripcion" id="txtDescripcion" rows="3"><?= $transaccion->Descripcion ?></textarea>
              </div>
            </div>
          </div>
          <hr>
          <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Editar</button>
            <a href="../index.php" class="btn btn-outline-secondary">Regresar</a>
          </div>
        </form>
      </div>
      </div>
    </main>
  <?php endif; ?>
  <!--Edit Content End-->
</body>
</html>