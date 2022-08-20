<?php
session_start();
include_once("ValidaSesion.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php

include('header.php');

include('menu.php');

$idauto = "";
$idmodelo = "";
$nombreauto = "";
$descripcionauto = "";
$destino = "";
$costoauto = "";

if(isset($_REQUEST['idaut'])){
  // echo "<script>alert('" .$_REQUEST["idaut"] ."');</script>";
  
  include('conexion.php');


  $sql = "SELECT * FROM auto WHERE md5(id_aut) = '" .$_REQUEST['idaut']. "'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
      $destino = "?idaut=" . md5($row['id_aut']);
      $idauto = $row['id_aut']; 
      $idmodelo = $row['id_mod']; 
      $nombreauto = $row['nom_aut'];
      $descripcionauto = $row['des_aut'];
      $costoauto = $row['cost_aut'];
      $urlFoto = $row["img_aut"];
    }
  } else {
    echo "0 results";
  }
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Producto</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Alta de autos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!--AQUI PONER EL CONTENIDO -->

                <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Llene los siguientes campos</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form enctype="multipart/form-data" action="autoAcciones.php<?= $destino ?>" method="post">
                <div class="card-body">

                  <div class="form-group">
                    <label for="idauto">ID de Auto</label>
                    <input type="text" disabled class="form-control" id="idauto" name="idauto" value="<?= $idauto; ?>" placeholder="Id del Auto">
                  </div>

                   
                  <div class="form-group">
                    <label for="nombre">Nombre del Auto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nombreauto; ?>" placeholder="Nombre del Auto" required="required">
                  </div>


                  <div class="form-group">
                    <label for="descripcion">Descripción del producto</label>
                    <textarea class="form-control" id="descripcion" name="descripcion"  placeholder="Descripcion del producto" required="required"><?php echo $descripcionauto; ?></textarea>
                  
                  </div>

                  <div class="form-group">
                    <label for="costo">Costo del Auto</label>
                    <input type="number" class="form-control" min="0" max="99999999" id="costo" name="costo" value="<?= $costoauto; ?>" placeholder="Nombre del Auto" required="required">
                  </div>

                  <div class="form-group">
                    <label for="idmodelo">Modelo del Auto</label>
                    <select name="idmodelo" class="form-control" required="required">
                      <option value="">Seleccione el modelo</option>
                      <?php

                      include('conexion.php');

                      $sql = "SELECT * FROM modelo";


                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          $selectedIdModelo = "";
                          if($row["id_mod"]=== $idmodelo){
                            $selectedIdModelo = " selected ";
                          }
                        echo "
                              <option $selectedIdModelo value='". $row["id_mod"] . "'>" .  $row["nom_mod"] . "</option>";

                        }
                      } else {
                        echo "0 results";
                      }
                      $conn->close();

                     
                      ?>
                    </select>
                    <div class="invalid-feedback">
                      El campo es requerido.
                    </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="fileToUpload"></label>Foto <br>
                    
                    <input required type="file" id="fileToUpload" name="fileToUpload">
                    <br><br>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="./plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./plugins/jszip/jszip.min.js"></script>
<script src="./plugins/pdfmake/pdfmake.min.js"></script>
<script src="./plugins/pdfmake/vfs_fonts.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
