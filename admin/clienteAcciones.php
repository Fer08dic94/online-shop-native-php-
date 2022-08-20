<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php


if(isset($_REQUEST["acc"]) && isset($_GET["idcli"]))
{

        include('conexion.php');

        $sql = "DELETE FROM cliente WHERE md5(id_clie) = '" .$_GET['idcli']."'";

        if($conn->query($sql) === TRUE) {
          echo "<script>window.location.href='clientelst.php';</script>";
        } else {
          echo "<div class='alert alert-warning'>
                <strong>Advertencia</strong> No puedes borrar este cliente.
                </div>";
        }

        $conn->close();
} 

?>


