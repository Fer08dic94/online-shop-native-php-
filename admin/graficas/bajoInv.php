<?php 
session_start();
include_once("../ValidaSesion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta http-equiv="refresh" content="2">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>

    <div class="container w-100">
        <br>
        <table class="table table-hover table-striped w-100">
            <thead style="background-color:black; color:white">
                <tr>
                    <th>Auto</th>
                    <th>Modelo</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../conexion.php");
                $sql = "select nom_aut,  modelo.nom_mod, stock_inv from auto
                inner join inventario on (auto.id_aut = inventario.id_aut)
                inner join sucursal on (sucursal.id_suc = inventario.id_suc)
                inner join modelo on (modelo.id_mod = auto.id_mod)
                inner join marca on (marca.id_mar = modelo.id_mar) order by stock_inv asc limit 10;";
                $result = $conn->query($sql);
                $Datos = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $alarma = "";
                        if ($row["stock_inv"] <= 30) {
                            $alarma = '<i style=";" class="fa-solid fa-triangle-exclamation"></i>';
                        }
                        echo "<tr>
                                <td>{$row["nom_aut"]}</td>
                                <td>{$row["nom_mod"]}</td>
                                <td>" . $row["stock_inv"] . " " . $alarma . "</td>
                            </tr>";
                    }
                }


                ?>

            </tbody>
        </table>
    </div>

</body>

</html>