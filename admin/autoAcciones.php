<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php

if(isset($_REQUEST["acc"]) && isset($_GET["idaut"]))
	{

			include('conexion.php');

			$sql = "DELETE FROM auto WHERE md5(id_aut) = '" .$_GET['idaut']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='autolst.php';</script>";
			} else {
			  echo "<div class='alert alert-warning'>
					<strong>Advertencia</strong> No puedes borrar este auto.
					</div>";
			}

			$conn->close();	
	}  else {


		// AQUI COMIENZA LA CARGA DEL ARCHIVO
$target_dir = "dist/uploadImgs/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$Fname = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false) {
	echo "File is an image - " . $check["mime"] . ".";
	$uploadOk = 1;
} else {
	echo "File is not an image.";
	$uploadOk = 0;
}


if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
	
		// aqui comienza la conexion



		if(isset($_GET['idaut']))
	{
			if(!isset($_REQUEST['nombre'])){

				echo "<script>alert('Error al recibir los datos');window.open('autolst.php');</script>";
			}

			$nombre = $_REQUEST['nombre'];
			$descripcion = $_REQUEST['descripcion'];
			$costo = $_REQUEST['costo'];
			$id_modelo = $_REQUEST['idmodelo'];
			//$foto = $_REQUEST['foto'];
			
			include('conexion.php');

			$sql = "UPDATE auto set nom_aut = '$nombre', des_aut = '$descripcion', cost_aut = '$costo', img_aut = '$Fname', id_mod = '$id_modelo' WHERE md5(id_aut)= '" .$_GET['idaut']."'";

			if($conn->query($sql) === TRUE) {
			  echo "<script>window.location.href='autolst.php';</script>";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();

	} 
	else 
	{

		if(!isset($_REQUEST["nombre"])) {
        echo "<script>alert('Error al recibir los datos');window.open('auto.php');</script>";
    }

    $nombre = $_REQUEST['nombre'];
	$descripcion = $_REQUEST['descripcion'];
	$costo = $_REQUEST['costo'];
	$id_modelo = $_REQUEST['idmodelo'];
	//$foto = $_REQUEST['foto'];

    include("conexion.php");

    $sql = "INSERT INTO auto (nom_aut, des_aut, cost_aut, img_aut, id_mod) 
    		values('" . $nombre . "', '" . $descripcion . "', '" . $costo . "' , '" . $Fname . "', '" . $id_modelo . "')";
	
    if($conn->query($sql) === TRUE) {
		//echo $sql;
		//$last_id = mysqli_insert_id($conn);
		//echo $last_id;
		//die();

		//$last_id = mysqli_insert_id($conn);
        //echo "New record created successfully. Last inserted ID is: " . $last_id;
		//die()
    	echo "<script>window.location.href='autolst.php';</script>";
    } else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    
}

} else {
		echo "Sorry, there was an error uploading your file.";
	}


}
	}






	





	

	
