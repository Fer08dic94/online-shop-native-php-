<?php
session_start();

include_once("ValidaSesion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 3</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->


<body class="hold-transition sidebar-mini">



  <div class="wrapper">
    <!-- GMV:  Aqui va el encabezado -->
    <?php
    include("header.php");
    ?>
    <!-- GMV: Poner aquí el Menú -->
    <?php
    include("menu.php");
    ?>



<?php 
include("conexion.php");
$clientes = 0;
$ventas = 0;
$autos = 0;
$total = 0;

$sql = "call indicadores();";
          // echo $sql;
           $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    
                     $clientes = $row['numclientes'];
                     $ventas = $row['numVentas'];
                     $total = $row['ventasTotales'];
                     $autos = $row['autosVendidos'];
                    
                }
             
        } 

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
  
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              

                <h3 style="color:white;"><?php echo $ventas; ?></h3>

                <p style="color:white;">Cantidad de Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 style="color:white;"><?php echo number_format(($total), 2, '.', ',') ?> <sup style="font-size: 20px">$</sup></h3>

                <p style="color:white;">Total vendido</p>
              </div>
              <div class="icon">
                <i class="ion ion-arrow-graph-up-right"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 style="color:white;"><?php echo $clientes; ?></h3>

                <p style="color:white;">Clientes registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 style="color:white;"><?php echo $autos; ?></h3>

                <p style="color:white;">Autos vendidos</p>
              </div>
              <div class="icon">
                <i class="ion ion-model-s"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- /.row -->
          <!-- Main row -->
          
          <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h4 class="card-title">Ventas por día</h4>
                    <a href="./graficas/column.php" target="_blank">Ver reporte</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <iframe width="100%" height="500px" src="./graficas/column.php"></iframe>
                  </div>
                  <!-- /.d-flex -->

                </div>
              </div>
        </div>

        <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h4 class="card-title">Participación de ventas por sucursal</h4>
                    <a href="./graficas/pie.php" target="_blank">Ver reporte</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <iframe width="100%" height="500px" src="./graficas/pie.php"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>


      <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h4 class="card-title">Productos con bajo inventario</h4>
                    <a href="./graficas/bajoinv.php" target="_blank">Ver reporte</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <iframe width="100%" height="500px" src="./graficas/bajoinv.php"></iframe>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h4 class="card-title">Ultimos productos comprados</h4>
                    <a href="./graficas/ultimoscomprados.php" target="_blank">Ver reporte</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <iframe width="100%" height="500px" src="./graficas/ultimoscomprados.php"></iframe>
                  </div>
                </div>
              </div>
            </div>



            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h4 class="card-title">Ventas por cliente</h4>
                    <a href="./graficas/ventasxcliente.php" target="_blank">Ver reporte</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <iframe width="100%" height="500px" src="./graficas/ventasxcliente.php"></iframe>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h4 class="card-title">Ventas por auto</h4>
                    <a href="./graficas/autosxfechas.php" target="_blank">Ver reporte</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <iframe width="100%" height="500px" src="./graficas/autosxfechas.php"></iframe>
                  </div>
                </div>
              </div>
            </div>

          </div>
    
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    <!-- Content Wrapper. Contains page content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard3.js"></script>
</body>

</html>