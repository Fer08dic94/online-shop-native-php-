<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php


	if(isset($_REQUEST["acc"]) && isset($_GET["idmun"]))
	{

			include('conexion.php');

			$sql = "DELETE FROM municipio WHERE md5(id_mun)= '" .$_GET['idmun']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='municipiolst.php';</script>";
			} else {
			  echo "<div class='alert alert-warning'>
					<strong>Advertencia</strong> No puedes borrar este municipio.
					</div>";
			}

			$conn->close();


	} 
	else 
	{

		if(isset($_GET['idmun']))
	{

			if(!isset($_REQUEST['nombre'])){

				echo "<script>alert('Error al recibir los datos');window.open('municipio.php');</script>";
			}

			$nombre = $_REQUEST['nombre'];
			$id_estado = $_REQUEST["estado"];


			include('conexion.php');

			$sql = "UPDATE municipio set nom_mun = '$nombre', id_est = '$id_estado' WHERE md5(id_mun)= '" .$_GET['idmun']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='municipiolst.php';</script>";
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
    $id_est = $_REQUEST["estado"];

    include("conexion.php");

    $sql = "insert into municipio (nom_mun, id_est) values('" . $nombre . "', '" . $id_est . "')";

    if($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='municipiolst.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

		

	}



	}

	
