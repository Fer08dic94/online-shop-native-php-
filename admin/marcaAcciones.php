<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php

	if(isset($_REQUEST["acc"]) && isset($_GET["idmar"]))
	{

			include('conexion.php');

			$sql = "DELETE FROM marca WHERE md5(id_mar)= '" .$_GET['idmar']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='marcalst.php';</script>";
			} else {
			  echo "<div class='alert alert-warning'>
					<strong>Advertencia</strong> No puedes borrar esta marca.
					</div>";
			}

			$conn->close();

		
	} 
	else 
	{

		if(isset($_GET['idmar']))
	{

			if(!isset($_REQUEST['nombre'])){

				echo "<script>alert('Error al recibir los datos');window.open('marca.php');</script>";
			}

			$nombre = $_REQUEST['nombre'];


			include('conexion.php');

			$sql = "UPDATE marca set nom_mar = '$nombre' WHERE md5(id_mar)= '" .$_GET['idmar']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='marcalst.php';</script>";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();



	} 
	else 
	{

		if(!isset($_REQUEST["nombre"])) {
        echo "<script>alert('Error al recibir los datos');window.open('marca.php');</script>";
    }

    $nombre = $_REQUEST["nombre"];

    include("conexion.php");

    $sql = "INSERT INTO marca (nom_mar) values('" . $nombre . "')";

    if($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='marcalst.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

		

	}



	}

	
