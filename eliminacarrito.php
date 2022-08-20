<?php
session_start();
$carrito = $_SESSION["sCarrito"];

if (isset($_GET["ida"])) {
    unset($carrito[$_GET["ida"]]);
    $_SESSION["sCarrito"] = $carrito;
    echo ("<script>window.location.href='carrito.php';</script>");
}

?>