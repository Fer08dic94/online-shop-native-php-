<?php
session_start();
unset($_SESSION['nomusu']);
unset($_SESSION['nomcliente']);
session_destroy(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <style>
body {
  background-image: url('../admin/dist/uploadImgs/sunset2.png');
}
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-info">
    <div class="card-header text-center">
      <a href="#" class="h2"><b>INICIO DE SESIÓN</b></a>
    </div>
    <div class="card-body">

      <form action="validau.php" method="post">
        <div class="input-group mb-3">
          <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
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
                          
                        echo "
                              <option value='". $row["id_suc"] . "'>" .  $row["nom_suc"] . "</option>";

                        }
                      } else {
                        echo "Lo sentimos, no hay modelos en exitencia.";
                      }
                      $conn->close();
                     
                      ?>
                    </select>
                    <div class="invalid-feedback">
                      El campo es requerido.
                    </div>
                  </div>
                </div>
          

         
                    </select>
                    <div class="invalid-feedback">
                      El campo es requerido.
                    </div>
                  </div>




        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-info btn-block">Iniciar sesión</button> <br>
          </div>
          <!-- /.col -->
        </div>
      </form>


    

<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 5px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>



<button class="open-button" onclick="openForm()">Recuperar contraseña </button>

<div class="form-popup" id="myForm">
  <form action="recuperar.php" method="post" class="form-container">

    <label for="correo"><b>Correo</b></label>
    <input type="text" placeholder="correo electronico" name="correo" id="correo" required>

    <label for="clave"><b>Pregunta</b></label>
    <input type="text" placeholder="clave" name="clave" id="clave" required>

    <button type="submit" class="btn">Enviar</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Cerrar</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>





     
      <!-- /.social-auth-links -->
      <br>
      <p class="mb-0"> ¿No tienes cuenta?
        <a href="/integra/admin/registro.php" class="text-center"> Crear cuenta</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
</body>
</html>
