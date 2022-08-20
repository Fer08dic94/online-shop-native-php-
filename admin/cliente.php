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

$idcliente = "";
$nombrecliente = "";
$apaternocliente = "";
$amaternocliente = "";
$correocliente = "";
$telefonocliente ="";
$callecliente = "";
$numexteriorcliente = "";
$numinteriorcliente = "";
$coloniacliente = "";
$codigopostalcliente = "";
$rfccliente = "";
$idmunicipiocliente = "";
$nombreusuario = "";
$destino = "";


if(isset($_REQUEST['idcli'])){
  // echo "<script>alert('" .$_REQUEST["idcli"] ."');</script>";

  
  include('conexion.php');


  $sql = "SELECT * FROM cliente WHERE md5(id_clie) = '" .$_REQUEST['idcli']. "'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
      $destino = "?idcli=" . md5($row['id_clie']);
      $idcliente = $row['id_clie']; 
      $nombrecliente = $row['nom_clie'];
      $apaternocliente = $row['ap_clie'];
      $amaternocliente = $row['am_clie'];
      $correocliente = $row['correo_clie'];
      $telefonocliente = $row['tel_clie'];
      $callecliente = $row['calle_clie'];
      $numexteriorcliente = $row['ne_clie'];
      $numinteriorcliente = $row['ni_clie'];
      $coloniacliente = $row['col_clie'];
      $codigopostalcliente = $row['cp_clie'];
      $rfccliente = $row['rfc_clie'];
      $idmunicipiocliente = $row['id_mun'];

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
            <h1>Clientes</h1>
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
                <h3 class="card-title">Clientes</h3>
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
              <form action="clienteAcciones.php<?= $destino ?>" method="post">
                <div class="card-body">

                  <div class="form-group">
                    <label for="idcliente">ID de Cliente</label>
                    <input type="text" disabled class="form-control" id="idcliente" name="idcliente" value="<?= $idcliente; ?>">
                  </div>

                   
                  <div class="form-group">
                    <label for="nombrecliente">Nombre</label>
                    <input type="text" disabled class="form-control" id="nombrecliente" name="nombrecliente" value="<?= $nombrecliente; ?>">
                  </div>

                  <div class="form-group">
                    <label for="apeterno">Apellido Paterno</label>
                    <input type="text" disabled class="form-control" id="apeterno" name="apeterno" value="<?= $apaternocliente; ?>">
                  </div>

                  <div class="form-group">
                    <label for="amaterno">Apellido Materno</label>
                    <input type="text" disabled class="form-control" id="amaterno" name="amaterno" value="<?= $amaternocliente; ?>">
                  </div>

                  <div class="form-group">
                    <label for="correo">Correo Electronico</label>
                    <input type="text" disabled class="form-control" id="correo" name="correo" value="<?= $correocliente; ?>">
                  </div>


                  <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" disabled class="form-control" id="telefono" name="telefono" value="<?= $telefonocliente; ?>">
                  </div>


                  <div class="form-group">
                    <label for="calle">Calle/Avenida</label>
                    <input type="text" disabled class="form-control" id="calle" name="calle" value="<?= $callecliente; ?>">
                  </div>

                  <div class="form-group">
                    <label for="ne">N° Exterior</label>
                    <input type="text" disabled class="form-control" id="ne" name="ne" value="<?= $numexteriorcliente; ?>">
                  </div>

                  <div class="form-group">
                    <label for="ni">N° Interior</label>
                    <input type="text" disabled class="form-control" id="ni" name="ni" value="<?= $numinteriorcliente; ?>">
                  </div>

                  <div class="form-group">
                    <label for="colonia">Colonia</label>
                    <input type="text" disabled class="form-control" id="colonia" name="colonia" value="<?= $coloniacliente; ?>">
                  </div>

                  <div class="form-group">
                    <label for="cp">Codigo Postal</label>
                    <input type="text" disabled class="form-control" id="cp" name="cp" value="<?= $codigopostalcliente; ?>">
                  </div>

                  <div class="form-group">
                    <label for="rfc">RFC</label>
                    <input type="text" disabled class="form-control" id="rfc" name="rfc" value="<?= $rfccliente; ?>">
                  </div>
                  

                  <div class="form-group">
                    <label for="municipio">Municipio</label>
                    <input type="text" disabled class="form-control" id="municipio" name="municipio" value="<?= $idmunicipiocliente; ?>">
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
