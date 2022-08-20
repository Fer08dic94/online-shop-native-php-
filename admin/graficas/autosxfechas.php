<?php 
session_start();
include_once("../ValidaSesion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
   <!-- <meta http-equiv="refresh" content="2"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
</head>

<body>

    <div class="container w-100">
        <br>

    <div class="col-md-2">
	<input type="text" name="From" id="From" class="form-control" placeholder="Desde"/>

    </div>
    <div class="col-md-2">
        <input type="text" name="to" id="to" class="form-control" placeholder="Hasta"/>
    </div>
    <div class="col-md-8">
        <input type="button" name="range" id="range" value="Enviar" class="btn btn-info"/>
    </div>
    <br>
    <br>
    <br>
    <?php
    include("../conexion.php");

    $query = "select venta.id_vta,auto.id_aut, auto.nom_aut, modelo.nom_mod, inv_vta.cant_prod, venta.fec_vta, sum(inv_vta.cant_prod * auto.prec_aut + (inv_vta.cant_prod * auto.prec_aut * 0.16)) as total from venta
    inner join inv_vta on inv_vta.id_vta = venta.id_vta 
    inner join cliente on cliente.id_clie = venta.id_clie
    inner join inventario on (inv_vta.id_inv = inventario.id_inv)
    inner join sucursal on (sucursal.id_suc = inventario.id_suc)
    inner join auto on (auto.id_aut = inventario.id_aut)
    inner join modelo on (modelo.id_mod = auto.id_mod) group by venta.id_vta order by fec_vta;";
                    

    //$sql = "select p.nombreproducto, dv.cantidad, v.fecha  from venta as v inner join detalleventa as dv on v.idventa = dv.idventa inner join cliente as c on v.idcliente = c.idcliente inner join producto as p on p.idproducto = dv.idproducto inner join sucursal as s on v.idsuc = s.idsucursal inner join inventario as i on i.idproducto = dv.idproducto order by v.fecha desc;";
  
    $sql = mysqli_query($conn, $query);
    ?>
    <div id="purchase_order">
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
        </tr>
    <?php while($row= mysqli_fetch_array($sql)) { ?>
        <tr>
        <td><?php echo $row["id_vta"]; ?></td>
        <td><?php echo $row["id_aut"]; ?></td>
        <td><?php echo $row["nom_aut"]; ?></td>
        <td><?php echo $row["nom_mod"]; ?></td>
        <td><?php echo $row["cant_prod"]; ?></td>
        <td><?php echo $row["fec_vta"]; ?></td>
        <td><?php echo $row["total"]; ?></td>
    
        </tr>
    <?php } ?>
        </table>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
            });
            $(function(){
                $("#From").datepicker();
                $("#to").datepicker();
            });
     
            $('#range').click(function(){
                var From = $('#From').val();
                var to = $('#to').val();
                if(From != '' && to != '')
                {
                    $.ajax({
                        url:"rango_autosxfechas.php",
                        method:"POST",
                        data:{From:From, to:to},
                        success:function(data)
                        {
                            $('#purchase_order').html(data);
                            $('#purchase_order').append(data.htmlresponse);
                        }
                    });
                }
                else
                {
                    alert("Porfavor seleccione la fecha");
                }
            });
        });
        </script>
    </body>
    </html>