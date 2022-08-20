<?php
if(!isset($_SESSION["nomusu"])){
    echo "<script>alert('Usuario incorrecto');window.location.href='index.php';</script>";
}

?>