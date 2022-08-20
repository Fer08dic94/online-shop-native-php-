<?php 
session_start();
include_once("../ValidaSesion.php");
?>

<input type="button" class="btn btn-primary" type="button" onclick="switchVisible();" value="Cambiar vista" />

<div id="chartContainer">
  
</div>

<script>

function switchVisible() {
      if (document.getElementById('tbl')) {

          if (document.getElementById('tbl').style.display == 'none') {
              document.getElementById('tbl').style.display = 'block';
              document.getElementById('chartContainer').style.display = 'none';
          }
          else {
              document.getElementById('tbl').style.display = 'none';
              document.getElementById('chartContainer').style.display = 'block';
          }
      }
}


</script>


<link href="../dist/assets/bootstrap.min.css" rel="stylesheet">
<link href="../dist/assets/style.css" rel="stylesheet">
<link href="../dist/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<script src="../dist/assets/js/jquery-1.12.4.min.js"></script>

<script src="../dist/assets/js/bootstrap.min.js"></script>
<div id="chartContainer"></div>

<?php
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

include("../conexion.php");
/*$sql = "select sum(i.precio) as venta, v.fecha  from venta as v
        inner join detalleventa as dv on v.idventa = dv.idventa
        inner join cliente as c on v.idcliente = c.idcliente
        inner join producto as p on p.idproducto = dv.idproducto
        inner join sucursal as s on v.idsuc = s.idsucursal 
        inner join inventario as i on i.idproducto = dv.idproducto
             where fecha >= '20220701' group by v.fecha";
             */


$sql = "select sum(auto.prec_aut * inv_vta.cant_prod) as total, venta.fec_vta from auto
inner join inventario on (inventario.id_aut = auto.id_aut)
inner join inv_vta on (inv_vta.id_inv = inventario.id_inv)
inner join sucursal on (sucursal.id_suc = inventario.id_suc)
inner join venta on (venta.id_vta = inv_vta.id_vta)
inner join cliente on (cliente.id_clie = venta.id_clie)
where fec_vta <'20230000'group by fec_vta order by fec_vta";             





$result = $conn->query($sql);
$Datos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Datos[] = array("y" => $row["total"], "label" =>  date("Y-m-d", strtotime($row["fec_vta"])));
        // array("y" => 268.46, "label" => "2022-07-08")
        // ara
    }
}
console_log($Datos);
echo "<br>";

?>

<script type="text/javascript">
    $(function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "dark2", //"light1", "light2", "dark1", "dark2"
            animationEnabled: true,
            zoomEnabled: true, 
            title: {
                text: ""
            },
            data: [{
                type: "column",
                xValueType: "dateTime",
                dataPoints: <?php echo json_encode($Datos, JSON_NUMERIC_CHECK); ?>
            }], 
            // aqui empiezan las fechas
          
            
            
        });
        chart.render();
    });
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



<div id="tbl" class="container w-100">
        <br>
        <table class="table table-hover table-striped w-100">
            <thead style="background-color:black; color:white">
                <tr>
                    <th>Total</th>
                    <th>Fecha</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                include("../conexion.php");
                $sql = "select sum(auto.prec_aut * inv_vta.cant_prod) as total, venta.fec_vta from auto
                inner join inventario on (inventario.id_aut = auto.id_aut)
                inner join inv_vta on (inv_vta.id_inv = inventario.id_inv)
                inner join sucursal on (sucursal.id_suc = inventario.id_suc)
                inner join venta on (venta.id_vta = inv_vta.id_vta)
                inner join cliente on (cliente.id_clie = venta.id_clie)
                where fec_vta <'20230000'group by fec_vta order by fec_vta";
                $result = $conn->query($sql);
                $Datos = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        
                        echo "<tr>
                                <td>{$row["total"]}</td>
                                <td>{$row["fec_vta"]}</td>
                            </tr>";
                    }
                }


                ?>

            </tbody>
        </table>
    </div>

