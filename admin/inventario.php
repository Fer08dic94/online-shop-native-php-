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

$idinventario = "";
// $fechainventario = date('d-m-y');
$stockinventario = "";
$idsucursal = "";
$idauto = "";
$destino = "";


if(isset($_REQUEST['idinv'])){
  // echo "<script>alert('" .$_REQUEST["idaut"] ."');</script>";

  
  include('conexion.php');


 $sql = "SELECT id_inv, stock_inv, id_suc, id_aut FROM inventario WHERE md5(id_inv) = '" .$_REQUEST['idinv']. "'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {  
      $destino = "?idinv=" . md5($row['id_inv']);
      $idinventario = $row['id_inv']; 
      //$fechainventario = $row['fec_inv']; 
      $stockinventario = $row['stock_inv'];
      $idsucursal = $row['id_suc'];
      $idauto = $row['id_aut'];    
     
      
      
     
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
            <h1>Inventarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Inventarios</li>
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
                <h3 class="card-title">Alta de inventarios</h3>
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
              <form action="inventarioAcciones.php<?= $destino ?>" method="post">
                <div class="card-body">

                  <div class="form-group">
                    <label for="inventario">ID de Inventario</label>
                    <input type="text" disabled class="form-control" id="inventario" name="inventario" value="<?= $idinventario ?>" placeholder="Id del inventario">
                  </div>

                  <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" min="0" max="300" class="form-control" id="stock" name="stock" value="<?= $stockinventario; ?>" placeholder="stock de inventario" required="required">
                  </div>

                  <div class="form-group">
                    <label for="idsucursal">Sucursal</label>
                    <select name="idsucursal" id="idsucursal" class="form-control" required="required">
                      <option value="">Seleccione la sucursal</option>
                      <?php

                      include('conexion.php');

                      $sql = "SELECT * FROM sucursal";


                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          $selectedIdSucursal = "";
                          if($row["id_suc"]===$idsucursal){
                            $selectedIdSucursal = " selected ";
                          }
                        echo "
                              <option $selectedIdSucursal value='". $row["id_suc"] . "'>" .  $row["nom_suc"] . "</option>";

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
                    <label for="idauto">Nombre de Auto</label>
                    <select name="idauto" id="idauto" class="form-control" required="required">
                      <option value="">Seleccione el auto</option>
                      <?php

                      include('conexion.php');

                      $sql = "SELECT * FROM auto";


                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          $selectedIdAuto = "";
                          if($row["id_aut"]===$idauto){
                            $selectedIdAuto = " selected ";
                          }
                        echo "
                              <option $selectedIdAuto value='". $row["id_aut"] . "'>" .  $row["nom_aut"] . "</option>";

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
