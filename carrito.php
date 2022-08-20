<?php  
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Item - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <?php include("header.php"); ?>


        <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <h1>Carrito de compras</h1>
                <?php

                $carrito = $_SESSION["sCarrito"];


                $cuentaCarrito = count($carrito);
                if ($cuentaCarrito > 0) {
                    echo ' <table id="example1" class="table table-bordered table-striped">
                    <thead class="table-dark">
                          <tr>
                            <th>IDAuto</th>
                            <th>Auto</th>
                            <th>Modelo</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Importe</th>
                            <th>Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>';
                    foreach ($carrito as $x => $x_value) {


                        include("./admin/conexion.php");
                        $sql = "SELECT *, nom_mod FROM auto 
                            INNER JOIN inventario ON auto.id_aut = inventario.id_aut
                            INNER JOIN modelo ON auto.id_mod = modelo.id_mod
                            INNER JOIN sucursal ON inventario.id_suc = sucursal.id_suc WHERE auto.id_aut = " . $x . " and sucursal.id_suc = " . $_SESSION["sSuc"];

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {


                                echo '<tr>
                                    <td>' . $row["id_aut"] . '</td>
                                    <td>' . $row["nom_aut"] . '</td>
                                    <td>' . $row["nom_mod"] . '</td>
                                    <td>' . $x_value . '</td>
                                    <td>' .'$' . number_format($row["prec_aut"],2, '.',',') .'</td>
                                    <td>' .'$'. number_format($row["prec_aut"] * $x_value,2, '.',',') . '</td>
                                    <td><a href="eliminacarrito.php?ida=' . $row["id_aut"] . '" class="btn btn-danger">Eliminar</a></td>
                                  </tr>
                                  ';
                            }
                        }
                    }
                    echo '</tbody>
                    </table>
                    <a class="btn btn-warning" href="checkout">Checkout</a>';
                } else {
                    echo "<br><br><h3>Aún no tienes nada en tu carrito, mira las siguientes recomendaciones.</h3>";
                }
                ?>
            </div>
        </div>
    </section>

        <!-- Related items section-->
        <section class="py-5 bg-info">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Autos similares</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                
                <?php 
                include("./admin/conexion.php");

                $sql = "SELECT modelo.nom_mod,auto.id_aut, auto.nom_aut, auto.prec_aut, auto.des_aut, auto.img_aut, inventario.stock_inv 
                    FROM auto 
                    INNER JOIN inventario ON(auto.id_aut = inventario.id_aut) 
                    INNER JOIN modelo ON(auto.id_mod = modelo.id_mod)
                    ORDER BY rand() limit 4";
                $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $urlFoto = "";
                        if(strlen($row["img_aut"]) < 20){
                          $urlFoto = "http://localhost/integra/admin/dist/uploadImgs/" .$row["img_aut"];
                        } else {
                             $urlFoto = $row["img_aut"];
                        }
                      echo '<div class="col mb-5">
                      <div class="card h-100">
                      <a href="item.php?idaut=' . md5($row["id_aut"]) . '"> <img class="card-img-top" src="'. $urlFoto .'" alt="..." /></a>
                      <div class="card-body p-4">
                              <div class="text-center">
                                  <h5 class="fw-bolder">'. $row["nom_aut"]. '</h5>
                                  <span class="fw-bolder">'.$row["nom_mod"].'</span> <br>

                                  $'.$row["prec_aut"]. '
                              </div>
                          </div>
                          <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                          <div class="text-center"><a class="btn btn-warning mt-auto" href="agregacarrito.php?ida=' . $row["id_aut"] .  '"> <i class="bi-cart-fill me-1"></i>Agregar al carrito</a></div>
                          </div>
                      </div>
                  </div>';
                       
                    }
                  } else {
                    echo "0 results";
                  }
                  $conn->close();
                ?>    
                
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
