<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php


	if(isset($_REQUEST["acc"]) && isset($_GET["idmod"]))
	{

			include('conexion.php');

			$sql = "DELETE FROM modelo WHERE md5(id_mod)= '" .$_GET['idmod']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='modelolst.php';</script>";
			} else {
			  echo "<div class='alert alert-warning'>
					<strong>Advertencia</strong> No puedes borrar este modelo.
					</div>";
			}

			$conn->close();


		
	} 
	else 
	{

		if(isset($_GET['idmod']))
	{

			if(!isset($_REQUEST['nombre'])){

				echo "<script>alert('Error al recibir los datos');window.open('modelo.php');</script>";
			}

			$nombre = $_REQUEST['nombre'];
			$id_marca = $_REQUEST['modelo'];


			include('conexion.php');

			$sql = "UPDATE modelo set nom_mod = '$nombre', id_mar = '$id_marca' WHERE md5(id_mod)= '" .$_GET['idmod']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='modelolst.php';</script>";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();



	} 
	else 
	{

		if(!isset($_REQUEST["nombre"])) {
        echo "<script>alert('Error al recibir los datos');window.open('modelo.php');</script>";
    }

    $nombre = $_REQUEST["nombre"];
    $id_mar = $_REQUEST["modelo"];

    include("conexion.php");

    $sql = "INSERT INTO modelo (nom_mod, id_mar) values('" . $nombre . "', '" . $id_mar . "')";

    if($conn->query($sql) === TRUE) {
    	echo "<script>window.location.href='modelolst.php';</script>";
    } else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    
}

}

	
