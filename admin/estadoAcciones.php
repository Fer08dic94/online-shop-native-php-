<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<?php


	if(isset($_REQUEST["acc"]) && isset($_GET["idest"]))
	{

			include('conexion.php');

			$sql = "DELETE FROM estado WHERE md5(id_est)= '" .$_GET['idest']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='estadolst.php';</script>";
			} else {
			  echo "<div class='alert alert-warning'>
					<strong>Advertencia</strong> No puedes borrar este estado.
					</div>";
			}

			$conn->close();

		
	} 
	else 
	{

		if(isset($_GET['idest']))
	{

			if(!isset($_REQUEST['nombre'])){

				echo "<script>alert('Error al recibir los datos');window.open('estado.php');</script>";
			}

			$nombre = $_REQUEST['nombre'];


			include('conexion.php');

			$sql = "UPDATE estado set nom_est = '$nombre' WHERE md5(id_est)= '" .$_GET['idest']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='estadolst.php';</script>";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();



	} 
	else 
	{

		if(!isset($_REQUEST["nombre"])) {
        echo "<script>alert('Error al recibir los datos');window.open('estado.php');</script>";
    }

    $nombre = $_REQUEST["nombre"];

    include("conexion.php");

    $sql = "INSERT  INTO estado (nom_est) values('" . $nombre . "')";

    if($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='estadolst.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

		

	}



	}

	
