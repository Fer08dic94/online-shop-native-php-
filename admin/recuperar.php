<?php
$correo = $_POST['correo'];
$clave = $_POST['clave'];

//echo $correo;
//echo $clave;
//echo "<br>";
 
include("conexion.php");
$sql="SELECT correo_clie, cont_usu, palabra, tipo_usu FROM usuario WHERE correo_clie = '$correo'";
//echo $sql;
echo "<br>";

$result = $conn->query($sql);
		
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        if($row["palabra"] === $clave) {
           $sql = "call contraseña('$correo', '$clave');";

          // echo $sql;
           $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    /*var_dump($row);
                    die();*/
                    echo ("<script>alert('Tu contraseña es: " . $row["recuperacion"] . "');window.location.href='index.php'</script>");
                }
            }   
        } else {
            echo ("<script>alert('Correo o clave incorrecta');window.location.href='index.php'</script>");
        }
    }
  } else {
    echo ("<script>alert('Correo o clave incorrecta');window.location.href='index.php'</script>");

}
$conn->close();
?>