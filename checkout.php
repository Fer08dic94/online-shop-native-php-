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


        <section class="">
      <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                
                 

                <?php 
                include("./admin/conexion.php");

                $sql = "SELECT *, municipio.nom_mun FROM cliente
                        INNER JOIN municipio ON (cliente.id_mun = municipio.id_mun) 
                        INNER JOIN usuario ON(usuario.correo_clie = cliente.correo_clie) WHERE md5(cliente.correo_clie) = '" .$_SESSION["sIdCliente"]  ."'   ";
                $result = $conn->query($sql);
                $c_nombre = "";
                $c_apaterno = "";
                $c_amaterno = "";
                $c_telefono = "";
                $c_calle = "";
                $c_ne = "";
                $c_ni = "";
                $c_colonia = "";
                $c_cp = "";
                $c_municipio = "";
                $c_rfc = "";

                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    $c_nombre = $row["nom_clie"];
                    $c_apaterno = $row["ap_clie"];  
                    $c_amaterno = $row["am_clie"]; 
                    $c_telefono = $row["tel_clie"];
                    $c_calle = $row["calle_clie"];
                    $c_ne = $row["ne_clie"];
                    $c_ni = $row["ni_clie"];
                    $c_colonia = $row["col_clie"];
                    $c_cp = $row["cp_clie"];
                    $c_municipio = $row["nom_mun"];
                    $c_rfc = $row["rfc_clie"];
                    }
                  } 



                  $carrito = $_SESSION["sCarrito"];
                  //var_dump($carrito);

                  $cuentaCarrito = count($carrito);

                  $TotalCompra = 0;
                  if ($cuentaCarrito > 0) {
                      
                      foreach ($carrito as $x => $x_value) {
                        include("./admin/conexion.php");

                        $sql = "SELECT prec_aut FROM auto 
                        INNER JOIN inventario ON inventario.id_aut = auto.id_aut 
                        INNER JOIN sucursal ON inventario.id_suc = sucursal.id_suc
                        WHERE auto.id_aut = " . $x . " and sucursal.id_suc = " . $_SESSION["sSuc"];

                       //echo $sql;
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $TotalCompra += ($row["prec_aut"] * $x_value);
                                }
                        }

                      }
                  }   

                 
                ?>   

            <div class="jumbotron text-left" style="margin-top: 1px;background-image: url(./admin/dist/uploadImgs/background2.jpg)">
                <h3 style="color:white;">PEDIDO CONFIRMADO PARA : <?php echo $c_nombre . " " . $c_apaterno .  " ". $c_amaterno ?> </h3>
                <h3 style="color:white;">DIRECCIÓN DE ENVÍO : <?php echo $c_calle. ", ". $c_ne. ", ". $c_colonia. ", ". " ". $c_cp. ", ". $c_municipio ?> </h3>
                <h3 style="color:white;">RFC PARA FACTURA : <?php echo $c_rfc ?> </h3>
                <h3 style="color:white;">EL SUBTOTAL DE COMPRA ES : <?php echo  number_format($TotalCompra, 2, '.', ',') ?> </h3>
                <h3 style="color:white;">EL IVA DE LA COMPRA ES : <?php echo number_format(($TotalCompra * 0.16), 2, '.', ',') ?> </h3>
                <hr class="my-2">
                <h1 class="text-center" style="color:white;">TOTAL A PAGAR</h1>
                <hr class="my-2">
                <h1 class="text-center" style="color:white;">$ <?php echo number_format(($TotalCompra*1.16),2); ?> </h1>
                  <div id="paypal-button-container"></div> 
                <p></p>
            </div>
              


           

                  <div class='product_wrapper'>

                  <form method='post' action='https://www.sandbox.paypal.com/cgi-bin/webscr'>

                      <!-- PayPal business email to collect payments -->
                      <input type='hidden' name='business' value='carscompany@personal.gmail.com'>

                      <!-- Details of item that customers will purchase -->
                      <input type='hidden' name='item_number' value='0'>
                      <input type='hidden' name='item_name' value=''>
                      <input type='hidden' name='amount' value='<?= ($TotalCompra*1.16) ?>'>
                      <input type='hidden' name='currency_code' value='MXN'>
                      <input type='hidden' name='no_shipping' value='1'>

                      <!-- PayPal return, cancel & IPN URLs -->
                      <input type='hidden' name='return' value='http://localhost/integra/confirmado.php'>
                      <input type='hidden' name='cancel_return' value='http://localhost/integra/cancelado.php'>
                      <input type='hidden' name='notify_url' value='http://localhost/integra/cancelado.php'>

                      <!-- Specify a Pay Now button. -->
                      <br>
                      <input type="hidden" name="cmd" value="_xclick">

                      <div class="d-grid gap-2 col-6 mx-auto">
                        <button onclick="alert('Saliendo del sitio para ir a Paypal')" class='btn btn-warning'  type='submit' class='pay'> <img src="./admin/dist/uploadImgs/paypallogo.png" height ="30" width="90" /></button>
                      <a class="btn btn-success" href="http://localhost/integra/confirmado.php">Pagar en efectivo</a>
                  </form>
                  </div>
                </div>

                </div>
            </div>
        </section>



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
                             <div class="text-center"><a class="btn btn-warning mt-auto href="#"> <i class="bi-cart-fill me-1"></i>Agregar al carrito</a></div>
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
