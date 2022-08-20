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
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Clientes</li>
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
                <h3 class="card-title">Listado de clientes</h3>
                <br>
                </div>
               
               
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="thead-dark">
                    <tr>
                    <th>IDCliente</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo electronico</th>
                    <th>Telefono</th>
                    <th>Calle/Avenida</th>
                    <th>N° Exterior</th>
                    <th>N° Interior</th>
                    <th>Colonia</th>
                    <th>Codigo Postal</th>
                    <th>RCF</th>
                    <th>Municipio</th>
                    <th>Estado</th>
                    <th>Ver</th>
                    <th>Eliminar</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 

                  include("conexion.php");
                    

                  $sql = "SELECT *, municipio.nom_mun, estado.nom_est FROM cliente 
                  INNER JOIN municipio ON (municipio.id_mun = cliente.id_mun)
                  INNER JOIN estado ON (estado.id_est = municipio.id_est)";
                  $result = $conn->query($sql);

                
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "
                          <tr>
                            <td>" . $row["id_clie"] . "</td>
                            <td>" . $row["nom_clie"] . "</td>
                            <td>" . $row["ap_clie"] . "</td>
                            <td>" . $row["am_clie"] . "</td>
                            <td>" . $row["correo_clie"] . "</td>
                            <td>" . $row["tel_clie"] . "</td>
                            <td>" . $row["calle_clie"] . "</td>
                            <td>" . $row["ne_clie"] . "</td>
                            <td>" . $row["ni_clie"] . "</td>
                            <td>" . $row["col_clie"] . "</td>
                            <td>" . $row["cp_clie"] . "</td>
                            <td>" . $row["rfc_clie"] . "</td>
                            <td>" . $row["nom_mun"] . "</td>
                            <td>" . $row["nom_est"] . "</td>
                            
                            <td><a href='cliente.php?idcli=" . md5($row["id_clie"]) . "'><i class=\"far fa-eye\"></i></a></td>
                            <td><a href='clienteAcciones.php?acc=elimina&idcli=" .  md5($row["id_clie"])  . "'><i class=\"fa fa-trash-alt\"></i></a></td>
                         
                           </tr>
                            ";
                    }
                  } else {
                    echo "0 results";
                  }
                  $conn->close();
                ?>
                 
                  
                  </tbody>
                  <tfoot class="thead-dark">
                  <tr>
                  <th>IDCliente</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo electronico</th>
                    <th>Telefono</th>
                    <th>Calle/Avenida</th>
                    <th>N° Exterior</th>
                    <th>N° Interior</th>
                    <th>Colinia</th>
                    <th>Codigo Postal</th>
                    <th>RCF</th>
                    <th>Municipio</th>
                    <th>Estado</th>
                    <th>Ver</th>
                    <th>Eliminar</th>
                  </tr>
                  </tfoot>
                </table>
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
