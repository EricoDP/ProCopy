<?php
  require_once './FileHandler/iFileHandler.php';
  require_once './FileHandler/FileHandlerBase.php';
  require_once './FileHandler/SerializationFileHandler.php';
  require_once './FileHandler/JsonFileHandler.php';

  require_once './operations/serviceFile.php';
  require_once './helpers/utilities.php';
  require_once './models/transaccion.php';

  $service = new ServiceFile();
  $utilities = new Utilities();

  $transacciones = $service->GetList();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Bootstrap-->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <script src="./assets/js/bootstrap.min.js"></script>
  <title>Procesador de Transacciones</title>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Top navbar</a>
    </div>
  </nav>
  <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Agregar Transaccion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="ms-1" action="./operations/add.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="fw-bold">Archivo de transaccion</div>
            <div class="ms-1">
              <div class="mb-3 ">
                <label for="archivoTransaccion" class="form-label">Archivo JSON de Transaccion</label>
                <div class="input-group">
                  <input class="form-control" type="file" accept=".json, .csv" id="archivoTransaccion" name="archivoTransaccion">
                  <button onclick="" class="btn btn-outline-primary" type="button">Enviar</button>
                </div>
              </div>
            </div>
            <div class="fw-bold">Formulario de transaccion</div>
            <div class="ms-1">
              <div class="mb-3">
                <label for="txtMonto" class="form-label">Monto</label>
                <div class="input-group mb-3">
                  <span class="input-group-text">$</span>
                  <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="Monto">
                  <span class="input-group-text">.00</span>
                </div>
              </div>
              <div class="md-3">
                <label for="txtDescripcion" class="form-label">Descripcion</label>
                <textarea class="form-control" name="Descripcion" id="txtDescripcion" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <main class="bg-white">
    <div class="container">
      <div class="bg-light p-5 rounded">
        <h1>Procesador de Transacciones</h1>
        <p class="lead">Este es un proyecto por el cual se gestionan transacciones. Se pueden registrar nuevas transacciones a la vez que se puede editar u eliminar cada una de estas.</p>
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#Modal">Agregar registro</button>
      </div>
    </div>
    <div class="py-5 mt-5 w-100 h-100 bg-light">
      <div class="container">
        <?php if(count($transacciones) < 1): ?>
          <h3 class="w-100 text-center">No hay registros de transacciones</h3>
        <?php else: ?>
          <div class="bg-white border border-secondary">
            <table class="table mb-0 shadow-sm">
              <thead class="table-dark rounded-top">
                <tr>
                  <th scope="col" class="text-center" style="width: 15%;">ID</th>
                  <th scope="col" style="width: 10%;">Monto</th>
                  <th scope="col" style="width: 20%;">Fecha y Hora</th>
                  <th scope="col" style="width: 35%;">Descripcion</th>
                  <th scope="col" style="width: 20%;"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($transacciones as $key => $transaccion): ?>
                  <tr>
                    <th scope="row"><?= $transaccion->ID ?></th>
                    <td>$<?= $transaccion->Monto ?>.00</td>
                    <td><?= $transaccion->Fecha ?></td>
                    <td><?= $transaccion->Descripcion ?></td>
                    <td>
                      <div class="btn-group border-start border-secondary ps-4 w-100">
                        <a href="./operations/edit.php?id=<?= $transaccion->ID ?>" type="button" class="btn btn-sm btn-success w-50">Editar</a>
                        <button onclick="deleteTransaccion('./operations/delete.php?id=<?= $transaccion->ID ?>')" type="button" class="btn btn-sm btn-danger w-50">Eliminar</button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </main>
  <script src="./assets/js/indexScript.js"></script>
</body>
</html>