<?php 
 include("conexion.php");
if(isset($_REQUEST["id_estado"])){
    $id_estado = $_REQUEST["id_estado"];
    //echo $id_estado;
   

$sql = "SELECT * FROM municipio WHERE id_est =  $id_estado";
    //echo $sql;
 
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
        '<option value="">Selecciona un municipio </option>';
         while($row = $result->fetch_assoc()) {
    
           echo
            "<option value='". $row["id_mun"] . "'>"  .  $row["nom_mun"] . "</option>";
    }
    } else {
    echo "0 results";
    }   
  
}

     
?>