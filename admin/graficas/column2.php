<!DOCTYPE HTML>
<html>
<head>


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



<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.stock.min.js"></script>
<script type="text/javascript">




window.onload = function () {
  var dataPoints = [];
  var stockChart = new CanvasJS.StockChart("chartContainer",{
    title:{
      text:"Litecoin Volume"
    },    
    charts: [{
      data: [{
        xValueType: "dateTime",
        type: "column",
        dataPoints : <?php echo json_encode($Datos, JSON_NUMERIC_CHECK); ?>
      }]
    }],
    rangeSelector: {        
      buttons: [],
      inputFields: {
        startValue: new Date(2018, 03, 01),
        endValue: new Date(2018, 04, 31)
      }
    }
  });
  $.getJSON("https://canvasjs.com/data/docs/ltcusd2018.json", function(data) {  
    for(var i = 0; i < data.length; i++){
      dataPoints.push({x: new Date(data[i].date), y: Number(data[i].volume_ltc)});
    }	
    stockChart.render();
  });
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 400px; width: 100%;"></div>
</body>
</html>