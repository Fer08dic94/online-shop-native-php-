<?php 
if(!isset($_REQUEST["correo"]) ) {
        echo "<script>alert('Error al recibir los datos');window.open('registro.php');</script>";
    }

    $correo = $_REQUEST["correo"];
    $contrasena = $_REQUEST["contrasena"];
    $palabra = $_REQUEST["palabra"];

    $nombrecliente = $_REQUEST["nombrecliente"];
    $apaterno = $_REQUEST["apaterno"];
    $amaterno = $_REQUEST["amaterno"];
    $telefono = $_REQUEST["telefono"];
    $calle = $_REQUEST["calle"];
    $ne = $_REQUEST["ne"];
    $ni = $_REQUEST["ni"];
    $colonia = $_REQUEST["colonia"];
    $cp = $_REQUEST["cp"];
    $rfc = $_REQUEST["rfc"];

    $municipio = $_REQUEST["id_municipio"];



    include("conexion.php");

    $sql = "INSERT INTO usuario (correo_clie, tipo_usu, cont_usu, palabra) VALUES('" . $correo . "',  1  , '". $contrasena ."', '". $palabra ."')";

    //$last_id = mysqli_insert_id($conn);
    //echo $sql;
    //echo $last_id;
    //die();
    $last_id = $correo;
    
    $sql2 = "INSERT INTO cliente (nom_clie, ap_clie, am_clie, correo_clie, tel_clie, calle_clie, ne_clie, ni_clie, col_clie, cp_clie, rfc_clie, id_mun) 
            VALUES(
                '" . $nombrecliente . "', '". $apaterno ."', '". $amaterno ."','". $last_id ."', '". $telefono ."','". $calle ."', '". $ne ."', '". $ni ."', '". $colonia ."', '". $cp ."', '". $rfc ."', '". $municipio ."' )";
    //echo "$sql '.<br>.'";
    //echo $sql2;
    
   
    if($conn->query($sql)  === TRUE  && $conn->query($sql2)  === TRUE) {

        //$last_id = mysqli_insert_id($conn);
        //echo $sql;
        //echo $last_id;
        //die();
        echo "<script>window.location.href='index.php';</script>";

        //$last_id = mysqli_insert_id($conn);
        //echo "New record created successfully. Last inserted ID is: " . $last_id;

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    
    
    ?>