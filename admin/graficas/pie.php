<?php 
session_start();
include_once("../ValidaSesion.php");
?>
<link href="../dist/assets/bootstrap.min.css" rel="stylesheet">
<link href="../dist/assets/style.css" rel="stylesheet">
<link href="../dist/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<script src="../dist/assets/js/jquery-1.12.4.min.js"></script>
<script src="../dist/assets/js/bootstrap.min.js"></script>

<input type="button" class="btn btn-primary" type="button" onclick="switchVisible();" value="Cambiar vista" />

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

<div id="chartContainer"></div>
<h1>Gráfica de participación de ingresos:
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
    $sql = "select sum(auto.prec_aut * inv_vta.cant_prod) as total, nom_suc from auto
    inner join inventario on (inventario.id_aut = auto.id_aut)
    inner join inv_vta on (inv_vta.id_inv = inventario.id_inv)
    inner join sucursal on (sucursal.id_suc = inventario.id_suc)
    inner join venta on (venta.id_vta = inv_vta.id_vta)
    inner join cliente on (cliente.id_clie = venta.id_clie)
    where fec_vta <'20230000'group by nom_suc order by nom_suc;";

    $result = $conn->query($sql);
    $Datos = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $Datos[] = array("y" => $row["total"], "legendText" =>  $row["nom_suc"], "label" => $row["nom_suc"]);
            // Array("y" => 685.04, "LegendText" => "Querétaro", "label" => "Querétaro")
        }
    }
    console_log($Datos);
    echo "<br>";
    ?>

    <script type="text/javascript">
        $(function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: ""
                },
                animationEnabled: true,
                legend: {
                    /*verticalAlign: "center",
                    horizontalAlign: "left",
                    fontSize: 20,
                    fontFamily: "Helvetica"*/
                },
                theme: "dark2", //ligth1, "ligth2", dark1, dark2
                data: [{
                    type: "pie",
                    indexLabelFontFamily: "Garamond",
                    indexLabelFontSize: 20,
                    indexLabel: "{label} ${y}",
                    startAngle: -20,
                    showInLegend: true,
                    toolTipContent: "{legendText} ${y}",
                    dataPoints: <?php echo json_encode($Datos, JSON_NUMERIC_CHECK); ?>
                }]
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
                    <th>Sucursal</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                include("../conexion.php");
                $sql = "select sum(auto.prec_aut * inv_vta.cant_prod) as total, nom_suc from auto
                inner join inventario on (inventario.id_aut = auto.id_aut)
                inner join inv_vta on (inv_vta.id_inv = inventario.id_inv)
                inner join sucursal on (sucursal.id_suc = inventario.id_suc)
                inner join venta on (venta.id_vta = inv_vta.id_vta)
                inner join cliente on (cliente.id_clie = venta.id_clie)
                where fec_vta <'20230000'group by nom_suc order by nom_suc;";
                $result = $conn->query($sql);
                $Datos = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        
                        echo "<tr>
                                <td>{$row["total"]}</td>
                                <td>{$row["nom_suc"]}</td>
                            </tr>";
                    }
                }


                ?>

            </tbody>
        </table>
    </div>