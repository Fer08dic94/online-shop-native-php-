<nav class="navbar navbar-expand-lg navbar navbar-dark bg-warning">
            <div class="container px-4 px-lg-5">
               <!-- <a class="navbar-brand" href="index.php">Logo</a>   -->             
                <img src='/integra/admin/dist/uploadImgs/logoauto.png'> 
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Marcas</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <?php 
						
						    include("./admin/conexion.php");

						    $sql = "SELECT *  FROM marca";
						    $result = $conn->query($sql);

						    if ($result->num_rows > 0) {
						
							    while($row = $result->fetch_assoc()) {
                                    echo  '<li><a class="dropdown-item" href="index.php?idmar=' . md5($row["id_mar"]) . '">' . $row["nom_mar"] . '</a></li>';
							    }
						    } else {
						        echo "0 results";
						    }
						    $conn->close();
						
						    ?>

                            </ul>
                        </li>
                        
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php"></a></li>
                        <a class="navbar-brand" href="#"><?php if(isset($_SESSION["nomcliente"])) { echo "Hola ". $_SESSION["nomcliente"]; }?></a>

                    </ul>
                       
            <form class="d-flex">

            <?php
                        
                include('./admin/conexion.php');


                $sql = "SELECT id_suc, nom_suc FROM sucursal";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {  
                    
                
                }
                } else {
                echo "0 results";
                }

                
                if (isset($_SESSION["nomcliente"])) {
                    $carrito = $_SESSION["sCarrito"];
                    $cuentaCarrito = 0;
                    foreach ($carrito as $x => $x_value) {
                        $cuentaCarrito += $x_value;
                    }
                    echo '<a href="carrito.php" class="btn btn-outline-dark" type="submit">
                          <i class="bi-cart-fill me-1"></i>
                          Carrito
                          <span class="badge bg-dark text-white ms-1 rounded-pill">' . $cuentaCarrito . '</span>
                        </a>  
                        
                        <a href="./admin/index.php?usr=0" class="btn btn-outline-dark" type="submit">
                        <i class="bi-person-circle"></i>
                        Cerrar sesión
                        </span>
                    </a>
                        ';
                } else {
                    echo '<a href="./admin" class="btn btn-outline-dark" type="submit">
                    <i class="bi-person-circle"></i>
                    Iniciar Sesión
                    </span>
                </a>';
                }
            ?>
                    </form>   
                    
                </div>
            </div>
        </nav>