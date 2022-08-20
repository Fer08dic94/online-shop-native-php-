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
            <h1>Ventas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Ventas</li>
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
                <h3 class="card-title">Lista de ventas</h3>
                <br>
                </div>
               
               
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="thead-dark">
                    <tr>
                    <th>IDVenta</th>
                    <th>IDInventario</th>
                    <th>Cantidad</th>
                    <th>Auto</th>
                    <th>Modelo</th>
                    <th>Fecha de Venta</th>
                    <th>IDCliente</th>
                    <th>Nombre</th>
                    <th>Apellido materno</th>
                    <th>Apellido paterno</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Calle</th>
                    <th>N° exterior</th>
                    <th>N° interior</th>
                    <th>Colonia</th>
                    <th>Codigo postal</th>
                    <th>RFC</th>
                    <th>Municipio</th>
                    <th>Estado</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 

                  include("conexion.php");
                    

                  $sql = "SELECT *, cliente.id_clie, cliente.nom_clie, cliente.ap_clie, cliente.am_clie, cliente.correo_clie, cliente.tel_clie, cliente.calle_clie, cliente.ne_clie, cliente.ni_clie, cliente.col_clie, cliente.cp_clie, cliente.rfc_clie, municipio.nom_mun, estado.nom_est, inv_vta.cant_prod ,auto.nom_aut, modelo.nom_mod FROM venta
                        INNER JOIN cliente ON (venta.id_clie = cliente.id_clie)
                        INNER JOIN municipio ON (municipio.id_mun = cliente.id_mun)
                        INNER JOIN estado ON (estado.id_est = municipio.id_est)
                        INNER JOIN inv_vta ON (inv_vta.id_vta = venta.id_vta)
                        INNER JOIN inventario ON (inventario.id_inv = inv_vta.id_inv)
                        INNER JOIN auto ON (auto.id_aut = inventario.id_aut)
                        INNER JOIN modelo ON (auto.id_mod = modelo.id_mod)
                        
                       ";
                  $result = $conn->query($sql);

                
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "
                            <tr>
                            <td>" . $row["id_vta"] . "</td>
                            <td>" . $row["id_inv"] . "</td>   
                            <td>" . $row["cant_prod"] . "</td>  
                            <td>" . $row["nom_aut"] . "</td>
                            <td>" . $row["nom_mod"] . "</td>    
                            <td>" . $row["fec_vta"] . "</td>   
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
                    <th>IDVenta</th>
                    <th>IDInventario</th>
                    <th>Cantidad</th>
                    <th>Auto</th>
                    <th>Modelo</th>
                    <th>Fecha de Venta</th>
                    <th>IDCliente</th>
                    <th>Nombre</th>
                    <th>Apellido materno</th>
                    <th>Apellido paterno</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Calle</th>
                    <th>N° exterior</th>
                    <th>N° interior</th>
                    <th>Colonia</th>
                    <th>Codigo postal</th>
                    <th>RFC</th>
                    <th>Municipio</th>
                    <th>Estado</th>
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
