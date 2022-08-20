<?php
session_start();
$sucParam = "";
if(isset($_SESSION["sSuc"]))
{
    if($_SESSION["sSuc"] > 0)
    {
    $sucParam = "&suc=" . $_SESSION["sSuc"];
    }
}

if (!isset($_SESSION["sCarrito"])) {
    echo ("<script>alert('Para usar el carrito deberá iniciar sesión');window.location.href='index.php';</script>");
}


$carrito = $_SESSION["sCarrito"];
$inventario = 0;
$idproducto = 0;


include("./admin/conexion.php");
$where = "";
if(isset($_GET["ida"])){
    $where = "auto.id_aut = " .$_GET["ida"];
}else {
    $where = "md5(auto.id_aut) = '" .$_GET["idaut"]. "'";
}


    $sql = "SELECT inventario.id_aut ,inventario.stock_inv FROM inventario 
    INNER JOIN sucursal ON(sucursal.id_suc = inventario.id_suc)
    INNER JOIN auto ON (auto.id_aut = inventario.id_aut) WHERE $where and sucursal.id_suc = " . $_SESSION["sSuc"] ;
    
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               $inventario = $row["stock_inv"];
               $idproducto = $row["id_aut"];
            }
        }
        $conn->close();

if(isset($_GET["ida"]) || isset($_GET["idaut"])){
    
    if(isset($_GET["cant"])){
        $idaut = $_GET["idaut"];
        $valor = $_GET["cant"];

        foreach ($carrito as $x => $x_value) {
            if (md5($x) == $_GET["idaut"]) {
                if(($valor + $x_value) <= $inventario){
                  $valor += $x_value;  
                }
                else {
                    $valor = $x_value;
                    echo ("<script>alert('Lo sentimos, no tenemos más existencias');window.location.href='index.php';</script>");
                }
            }
        }

        unset($carrito[$idproducto]);
        $carrito += array($idproducto => $valor);
        $_SESSION["sCarrito"] = $carrito;
        echo ("<script>window.location.href='index.php';</script>");

    } else {
        $valor = 1;
        foreach ($carrito as $x => $x_value) {
            if (strtoupper($x) == $_GET["ida"]) {
                //die($valor + $x_value);
                if(($valor + $x_value) <= $inventario){
                  $valor += $x_value;  
                }
                else {
                    $valor = $x_value;
                    echo ("<script>alert('Lo sentimos, no tenemos más existencias');window.location.href='index.php';</script>");
                }
            }
        }

        unset($carrito[$_GET["ida"]]);
        $carrito += array($_GET["ida"] => $valor);
        $_SESSION["sCarrito"] = $carrito;
        echo("<script>window.location.href='index.php';</script>");

    }

}

?>