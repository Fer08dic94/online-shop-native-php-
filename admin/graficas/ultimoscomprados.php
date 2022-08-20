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
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../conexion.php");
                //$sql = "select p.nombreproducto, dv.cantidad, v.fecha  from venta as v inner join detalleventa as dv on v.idventa = dv.idventa inner join cliente as c on v.idcliente = c.idcliente inner join producto as p on p.idproducto = dv.idproducto inner join sucursal as s on v.idsuc = s.idsucursal inner join inventario as i on i.idproducto = dv.idproducto order by v.fecha desc;";
                $sql = "select auto.nom_aut, modelo.nom_mod, inv_vta.cant_prod, venta.fec_vta from venta
                inner join inv_vta on inv_vta.id_vta = venta.id_vta 
                inner join cliente on cliente.id_clie = venta.id_clie
                inner join inventario on (inv_vta.id_inv = inventario.id_inv)
                inner join sucursal on (sucursal.id_suc = inventario.id_suc)
                inner join auto on (auto.id_aut = inventario.id_aut)
                inner join modelo on (modelo.id_mod = auto.id_mod) order by fec_vta desc";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $fecha = date("Y-m-d", strtotime($row["fec_vta"]));
                        echo "<tr>
                                <td>{$row["nom_aut"]}</td>
                                <td>{$row["nom_mod"]}</td>
                                <td>{$row["cant_prod"]}</td>
                                <td>" . $fecha . "</td>
                            </tr>";
                    }
                }


                ?>

            </tbody>
        </table>
    </div>

</body>

</html>