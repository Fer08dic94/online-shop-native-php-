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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">

  <style>
body {
  background-image: url('../admin/dist/uploadImgs/sunset2.png');
}
</style>


  <script type="text/javascript">
        $(document).ready(function(){
            $("#id_estado").change(function(){
                var id_estado = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "ajaxDatos.php",
                        //data: {"id_estado=": id_estado},
                        data:'id_estado=' + id_estado,
                        success: function(html){
                            console.log(html);
                            $("#id_municipio").html(html);
                        }
                    });
                
            });
        });
    </script>


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro</h1>
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
          <div class="col-10">
            

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
              <form action="registroAcciones.php" method="post">
                <div class="card-body">


                 <!-- <div class="form-group">
                    <label for="idcliente">ID de Cliente</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-user"></i></span>
                    </div>
                    <input type="text" disabled class="form-control" id="idcliente" name="idcliente" value="">
                    </div>  
                </div> 

                -->


                <div class="form-group">
                    <label for="correo">Correo Electronico</label>
                    <input required type="text" class="form-control" id="correo" name="correo" value="" placeholder="Ingrese su correo electronico">
                  </div>


                  <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input required type="password" class="form-control" id="contrasena" name="contrasena" value="" placeholder="Ingrese una contraseña">
                  </div>

                  <div class="form-group">
                    <label for="palabra">Palabra de seguridad</label>
                    <input required type="text" class="form-control" id="palabra" name="palabra" value="" placeholder="Ingrese una palabra de seguridad">
                  </div>

                   
                  <div class="form-group">
                    <label for="nombrecliente">Nombre</label>
                    <input required type="text" class="form-control" id="nombrecliente" name="nombrecliente" value="" placeholder="Ingrese su nombre">
                  </div>

                  <div class="form-group">
                    <label for="apaterno">Apellido Paterno</label>
                    <input required type="text" class="form-control" id="apaterno" name="apaterno" value="" placeholder="Ingrese su apellido paterno">
                  </div>

                  <div class="form-group">
                    <label for="amaterno">Apellido Materno</label>
                    <input required type="text" class="form-control" id="amaterno" name="amaterno" value="" placeholder="Ingrese su apellido materno">
                  </div>

                  <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input required type="text" class="form-control" id="telefono" name="telefono" value="" placeholder="Ingrese su telefono">
                  </div>

                  <div class="form-group">
                    <label for="calle">Calle/Avenida</label>
                    <input required type="text"  class="form-control" id="calle" name="calle" value="" placeholder="Ingrese su calle/avenida">
                  </div>

                  <div class="form-group">
                    <label for="ne">N° Exterior</label>
                    <input required type="text" class="form-control" id="ne" name="ne" value="" placeholder="Ingrese su numero exterior">
                  </div>

                  <div class="form-group">
                    <label for="ni">N° Interior (opcional)</label>
                    <input type="text" class="form-control" id="ni" name="ni" value="" placeholder="Ingrese su numero interior">
                  </div>

                  <div class="form-group">
                    <label for="colonia">Colonia</label>
                    <input required type="text" class="form-control" id="colonia" name="colonia" value="" placeholder="Ingrese su colonia">
                  </div>

                  <div class="form-group">
                    <label for="cp">Codigo Postal</label>
                    <input required type="text" class="form-control" id="cp" name="cp" value="" placeholder="Ingrese su codigo postal">
                  </div>

                  <div class="form-group">
                    <label for="rfc">RFC</label>
                    <input type="text" class="form-control" id="rfc" name="rfc" value="" placeholder="Ingrese su RFC">
                  </div>

                  <div class="form-group">

                    <label for="estado">Estado</label>
                    <select required name="estado" id="id_estado" class="form-control" required="required">
                      <option value="">Seleccione un estado</option>
                      <?php

                      include('conexion.php');

                      $sql = "SELECT * FROM estado";


                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                        echo "
                              <option value='". $row["id_est"] . "'>" . $row["nom_est"]. "</option>";

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

            <label for="municipio">Municipio</label>
                  <div> 
                  <select class="form-control" name="id_municipio" id="id_municipio">
                      <option value="">Selecciona un municipio</option>
                  </select>

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
