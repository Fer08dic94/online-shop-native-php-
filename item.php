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
        <!-- Navigation-->
        <?php 
        include("header.php");
        ?>
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <?php
                    include("./admin/conexion.php");

                    $sql = "SELECT auto.id_aut, auto.nom_aut, auto.prec_aut, auto.des_aut, auto.img_aut, inventario.stock_inv
                    FROM auto 
                    INNER JOIN inventario ON(auto.id_aut = inventario.id_aut)
                    WHERE MD5(auto.id_aut) = '" . $_REQUEST["idaut"]."'";
                    $result = $conn->query($sql);
                    
                    $mininventario = 1;
                    $idauto = 0;
                    $nombreauto = "";
                    $precioauto = 0;
                    $descripcionauto = "";
                    $imgauto = "";
                    $inventario = 0;
                    

                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $urlFoto = "";
                        if(strlen($row["img_aut"]) < 20){
                          $urlFoto = "http://localhost/integra/admin/dist/uploadImgs/" .$row["img_aut"];

                            } else {
                             $urlFoto = $row["img_aut"];
                        }
                        $idauto = $row["id_aut"];
                        $nombreauto = $row["nom_aut"];
                        $precioauto = $row["prec_aut"];
                        $descripcionauto = $row["des_aut"];
                        $imgauto = $row["img_aut"];
                        $inventario = $row["stock_inv"];
                       
                    }
                  } else {
                    echo "0 results";
                  }
                  if($inventario < 1){
                    $mininventario = 0;
                  }
                  $conn->close();
                    ?>
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?= $urlFoto ?>" alt="..." /></div>
                    <div class="col-md-6">
                        
                        <div class="small mb-1">SKU: <?= $_REQUEST["idaut"]; ?></div>
                        <h1 class="display-5 fw-bolder"><?= $nombreauto ?></h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through"><?= $precioauto * 1.3 ?></span>
                            <span>$<?= $precioauto ?></span>
                        </div>
                        <p class="lead"><?= $descripcionauto ?></p>
                        <form action="agregacarrito.php" method="get">
                        <input type="text" style="visibility:hidden;" value="<?= $_REQUEST['idaut'] ?>" name="idaut" value="idaut">
                        <div class="d-flex">
                          <?php
                          if($mininventario < 1){
                              echo '<div class="alert alert-warning" role="alert">
                              Lo sentimos, este auto ya no esta en existencia.
                            </div>';
                          } else {
                            echo '<br><input required class="form-control text-center me-3" id="cant" name="cant" type="number" value="0" min="' . $mininventario . '" max="' . $inventario . '" style="max-width: 5rem" />
                            <input type="submit" value="Añadir al carrito" class="btn btn-warning flex-shrink-0">';

                          }
                          ?>
                        
    
                          </div>
                        </form>
                    </div>
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
