<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php


if(isset($_REQUEST["acc"]) && isset($_GET["idinv"]))
{

        include('conexion.php');

        $sql = "DELETE FROM inventario WHERE md5(id_inv) = '" .$_GET['idinv']."'";

        if($conn->query($sql) === TRUE) {
          echo "<script>window.location.href='inventariolst.php';</script>";
        } else {
          echo "<div class='alert alert-warning'>
					<strong>Advertencia</strong> No puedes borrar este inventario.
					</div>";
        }

        $conn->close();
} 
else 
{

    if(isset($_GET['idinv']))
{

        if(!isset($_REQUEST['stock'])){ // tiene que recibir un dato del form 

            echo "<script>alert('Error al recibir los datos');window.open('inventario.php');</script>";
        }

        $stock = $_REQUEST['stock'];
        $id_sucursal = $_REQUEST['idsucursal'];
        $id_auto = $_REQUEST['idauto'];
        
        include('conexion.php');

        $sql = "UPDATE inventario set fec_inv = now() , stock_inv = '$stock', id_suc = '$id_sucursal', id_aut = '$id_auto' WHERE md5(id_inv)= '" .$_GET['idinv']."'";

        if($conn->query($sql) === TRUE) {
          echo "<script>window.location.href='inventariolst.php';</script>";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();



} 
else 
{

    if(!isset($_REQUEST["stock"])) { // tiene que recibir un dato del form
    echo "<script>alert('Error al recibir los datos');window.open('inventario.php');</script>";
}

$stock = $_REQUEST['stock'];
$id_sucursal = $_REQUEST['idsucursal'];
$id_auto = $_REQUEST['idauto'];

include("conexion.php");

$sql = "insert into inventario (fec_inv, stock_inv, id_suc, id_aut) 
        values('" . DATE('Y-m-d') . "', '" . $stock . "', '" . $id_sucursal . "', '" . $id_auto . "')";

if($conn->query($sql) === TRUE) {
    echo "<script>window.location.href='inventariolst.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

}


