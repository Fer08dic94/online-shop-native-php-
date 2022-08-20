<?php
session_start();
//include_once("./ValidaSesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
body {
  background-image: url('./admin/dist/uploadImgs/sunset2.png');
}
</style>

<br><br><br>


<?php

 include("admin/conexion.php");

$carrito = $_SESSION["sCarrito"];



                //include("admin/conexion.php");
                //$sql = "select p.nombreproducto, dv.cantidad, v.fecha  from venta as v inner join detalleventa as dv on v.idventa = dv.idventa inner join cliente as c on v.idcliente = c.idcliente inner join producto as p on p.idproducto = dv.idproducto inner join sucursal as s on v.idsuc = s.idsucursal inner join inventario as i on i.idproducto = dv.idproducto order by v.fecha desc;";
        
                /*$sql = "SELECT cliente.id_clie,
                factura.fol_fac, sucursal.nom_suc, venta.id_vta, venta.fec_vta FROM cliente 
                INNER JOIN venta ON (venta.id_clie = cliente.id_clie)
                INNER JOIN inv_vta ON (venta.id_vta = inv_vta.id_vta)
                INNER JOIN inventario ON (inventario.id_inv = inv_vta.id_inv)
                INNER JOIN sucursal ON (sucursal.id_suc = inventario.id_suc)
                INNER JOIN factura ON (venta.id_vta = factura.id_vta)
                INNER JOIN municipio ON (cliente.id_mun = municipio.id_mun) 
                INNER JOIN estado ON (estado.id_est = municipio.id_est)
                INNER JOIN usuario ON(usuario.correo_clie = cliente.correo_clie) WHERE md5(cliente.correo_clie) = '" .$_SESSION["sIdCliente"]  ."'";
                  $result = $conn->query($sql);
                  $id_clie = "";
                   
               
                 if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) {  
                       $id_clie = $row["id_clie"];
                       
                   }
                 } else {
                   echo "0 results";
                 }*/
                 //var_dump($carrito);
                 //foreach($_SESSION["sCarrito"] as $key=> $value){
                  //echo "$key -> $value"; 
                  //echo "<br> ";
                //} 

       $sql = "INSERT INTO venta (id_vta,fec_vta, id_clie) VALUES(0,now(), '" .  $_SESSION["idcli"] . "')";
        //echo ($sql);
        
        if($conn->query($sql)  === TRUE) {
          $last_id = $conn->insert_id;
          
         //die();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql_fac = "INSERT INTO factura (fol_fac, fec_fac, id_vta) VALUES (0,now(),'" . $last_id . "')";
        if($conn->query($sql_fac)  === TRUE) {
          
        } else {
            echo "Error: " . $sql_fac . "<br>" . $conn->error;
        }

        

        foreach($_SESSION["sCarrito"] as $key=> $value){
          // $_SESSION["sSuc"]
          // $key
          //select idinv from inventario where id_aut = 12 and id_suc = 2;


          $sql = "SELECT id_inv FROM inventario WHERE id_aut = $key AND id_suc = " . $_SESSION["sSuc"] ;
          
          //echo $sql;
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $sql2 = "INSERT INTO inv_vta (id_inv, id_vta, cant_prod) VALUES('" . $row["id_inv"] . "', '" . $last_id . "','" . $value . "')";
                //echo $sql2;
      
      
                if($conn->query($sql2)  === TRUE) {
          
                  //die();
                 } else {
                     echo "Error: " . $sql2 . "<br>" . $conn->error;
                 }

              }
          }
         
        }  

        $conn->close();

?>

<center>
    <h1 style="color:white;">Compra confirmada</h1>
    <a href="Factura.php?idvta=<?= $last_id ?>" class="btn btn-success" role="button" aria-pressed="true">Descargar Factura</a>

</center>






