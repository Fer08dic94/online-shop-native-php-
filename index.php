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
        <title></title>
         
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.4.1/css/bootstrap.min.css">

    </head>
    <body>
        <!-- Navigation-->
  <?php 
  include("header.php");
  ?>
  
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./admin/dist/uploadimgs/banner2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
    <div class="carousel-item">
      <img src="./admin/dist/uploadimgs/banner1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
    <div class="carousel-item">
      <img src="./admin/dist/uploadimgs/banner3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                   <?php 
                   
				   include("./admin/conexion.php");
					
				   $whereidmar = "";
               		 if (isset($_REQUEST["idmar"])) {
                   	 $whereidmar = " WHERE md5(marca.id_mar) ='" . $_REQUEST["idmar"] . "'";
                     
                    }

            $whereidsuc = "";
                    if (isset($_SESSION["sSuc"])) {
                    
                   	 $whereidsuc = " and  (sucursal.id_suc) ='" . $_SESSION["sSuc"] . "'";
                     
                    }

                    $sql = "SELECT auto.id_aut,auto.nom_aut, auto.img_aut, auto.prec_aut, modelo.nom_mod, marca.nom_mar, sucursal.id_suc, sucursal.nom_suc FROM auto 
                    INNER JOIN modelo ON(auto.id_mod = modelo.id_mod)
                    INNER JOIN inventario ON(inventario.id_aut = auto.id_aut)
                    INNER JOIN sucursal ON (sucursal.id_suc = inventario.id_suc)
                    INNER JOIN marca ON modelo.id_mar = (marca.id_mar)" .$whereidmar . $whereidsuc;
                    //echo $sql;
          
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    
						while($row = mysqli_fetch_assoc($result)) {
                            $urlFoto = "";
                            if(strlen($row["img_aut"]) < 20){
                                $urlFoto = "http://localhost/integra/admin/dist/uploadImgs/" .$row["img_aut"];

                             } else {
                            $urlFoto = $row["img_aut"];
                            }
              $sucParam = "";
              if(isset($_SESSION["sSuc"]))
              {
                  if($_SESSION["sSuc"] > 0)
                  {
                    $sucParam = "&suc=" . $_SESSION["sSuc"];
                  }
              }
							echo '<div class="col mb-5">
							<div class="card h-100">
								<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Nuevo</div>
								<a href="item.php?idaut=' . md5($row["id_aut"]) . '"> <img class="card-img-top" src="'. $urlFoto .'" alt="..." /></a>
								<div class="card-body p-4">
									<div class="text-center">
                  <h5 class="fw-bolder">'.$row["nom_suc"].'</h5> 

										<h5 class="fw-bolder">'.$row["nom_aut"].'</h5> 
										<span class="fw-bolder">'.$row["nom_mod"].'</span> <br>
										<span>$'.$row["prec_aut"].'</span>
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

					mysqli_close($conn);
                   
                   ?>
                    
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
