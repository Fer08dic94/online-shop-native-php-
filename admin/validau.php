<?php
session_start();


if(isset($_POST["usuario"]) && isset($_POST["pass"]) && isset($_POST["idsucursal"])){
  $usuario = $_POST["usuario"];
  $pass = $_POST["pass"];
  $suc  = $_POST["idsucursal"];
}


include('conexion.php');

$sql="SELECT cliente.id_clie, usuario.correo_clie, cont_usu, tipo_usu, cliente.nom_clie
FROM usuario 
INNER JOIN cliente WHERE cliente.correo_clie = usuario.correo_clie and usuario.correo_clie = '$usuario' and cont_usu = aes_encrypt('$pass','clave')";

$result = $conn->query($sql);

if($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {

        if($row["tipo_usu"] > 0){

            $_SESSION["sIdCliente"] = md5($row["correo_clie"]);
            $_SESSION["nomcliente"] = $row["nom_clie"];
            $_SESSION["idcli"] = $row["id_clie"];
            $carrito = array();
            $_SESSION["sCarrito"] = $carrito;
            $_SESSION["sSuc"] = $_POST["idsucursal"];
            echo ("<script>window.location.href='../index.php';</script>");

        } else{

          $_SESSION["nomusu"] = $row["correo_clie"];
          $carrito = array();
          $_SESSION["carrito"] = $carrito;
          echo ("<script>window.location.href='dashboard.php';</script>");
            }
    }
} else {
    echo ("<script>alert('Usuario incorrecto');window.location.href='index.php'</script>");
}
$conn->close();
