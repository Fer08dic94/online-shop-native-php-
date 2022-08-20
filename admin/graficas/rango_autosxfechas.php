<?php
include("../conexion.php");
if(isset($_POST["From"], $_POST["to"]))
{
    $result = '';
    //$query = "SELECT * FROM orders WHERE purchased_date BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'";
    $query = "select venta.id_vta,auto.id_aut, auto.nom_aut, modelo.nom_mod, inv_vta.cant_prod, venta.fec_vta, sum(inv_vta.cant_prod * auto.prec_aut + (inv_vta.cant_prod * auto.prec_aut * 0.16)) as total from venta
    inner join inv_vta on inv_vta.id_vta = venta.id_vta 
    inner join cliente on cliente.id_clie = venta.id_clie
    inner join inventario on (inv_vta.id_inv = inventario.id_inv)
    inner join sucursal on (sucursal.id_suc = inventario.id_suc)
    inner join auto on (auto.id_aut = inventario.id_aut)
    inner join modelo on (modelo.id_mod = auto.id_mod) where venta.fec_vta between '".$_POST["From"]."' AND '".$_POST["to"]."' group by venta.id_vta order by fec_vta;";
    $sql = mysqli_query($conn, $query);
    $result .='
    <table class="table table-hover table-striped w-100">
            <thead style="background-color:black; color:white">
                <tr>
                    <th>IDVenta</th>
                    <th>IDAuto</th>
                    <th>Auto</th>
                    <th>Modelo</th>
                    <th>Cantidad</th>
                    <th>Fecha venta</th>
                    <th>Total de venta</th>
                </tr>
            </thead>
    </tr>';
    if(mysqli_num_rows($sql) > 0)
    {
        while($row = mysqli_fetch_array($sql))
        {
            $result .='
            <tr>
            <td>'.$row["id_vta"].'</td>
            <td>'.$row["id_aut"].'</td>
            <td>'.$row["nom_aut"].'</td>
            <td>'.$row["nom_mod"].'</td>
            <td>'.$row["cant_prod"].'</td>
            <td>'.$row["fec_vta"].'</td>
            <td>'.$row["total"].'</td>
            </tr>';
        }
    }
    else
    {
        $result .='
        <tr>
        <td colspan="5">No Purchased Item Found</td>
        </tr>';
    }
    $result .='</table>';
    echo $result;
}
?>