<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php


	if(isset($_REQUEST["acc"]) && isset($_GET["idsuc"]))
	{

			include('conexion.php');

			$sql = "DELETE FROM sucursal WHERE md5(id_suc)= '" .$_GET['idsuc']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='sucursallst.php';</script>";
			} else {
			  echo "<div class='alert alert-warning'>
			  <strong>Advertencia</strong> No puedes borrar esta sucursal.
			  </div>";
			}

			$conn->close();


	} 
	else 
	{

		if(isset($_GET['idsuc']))
	{

			if(!isset($_REQUEST['nombre'])){

				echo "<script>alert('Error al recibir los datos');window.open('sucursal.php');</script>";
			}

			$nombre = $_REQUEST['nombre'];
			$id_municipio = $_REQUEST["municipio"];


			include('conexion.php');

			$sql = "UPDATE sucursal set nom_suc = '$nombre', id_mun = '$id_municipio' WHERE md5(id_suc)= '" .$_GET['idsuc']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='sucursallst.php';</script>";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();



	} 
	else 
	{

		if(!isset($_REQUEST["nombre"])) {
        echo "<script>alert('Error al recibir los datos');window.open('municipio.php');</script>";
    }

    $nombre = $_REQUEST["nombre"];
    $id_mun = $_REQUEST["municipio"];

    include("conexion.php");

    $sql = "insert into sucursal (nom_suc, id_mun) values('" . $nombre . "', '" . $id_mun . "')";

    if($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='sucursallst.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

		

	}



	}

	
