<?php
require_once dirname(__FILE__) . '/admin/dist/pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

session_start();

// consulta del cliente receptor, fechas, id venta, id factura
// consulta de detalle venta

include("./admin/conexion.php");

if(!isset( $_REQUEST["idvta"]))
{
	die("No se proporciono el No. de venta.");
}

$sql = "SELECT cliente.nom_clie, cliente.ap_clie, cliente.am_clie, cliente.calle_clie, cliente.ne_clie, cliente.col_clie ,cliente.cp_clie, cliente.rfc_clie ,municipio.nom_mun, estado.nom_est,
factura.fol_fac, sucursal.nom_suc, venta.id_vta, venta.fec_vta FROM cliente 
left outer JOIN venta ON (venta.id_clie = cliente.id_clie)
left outer JOIN inv_vta ON (venta.id_vta = inv_vta.id_vta)
left outer JOIN inventario ON (inventario.id_inv = inv_vta.id_inv)
left outer JOIN sucursal ON (sucursal.id_suc = inventario.id_suc)
left outer JOIN factura ON (venta.id_vta = factura.id_vta)
left outer JOIN municipio ON (cliente.id_mun = municipio.id_mun) 
left outer JOIN estado ON (estado.id_est = municipio.id_est)
left outer JOIN usuario ON(usuario.correo_clie = cliente.correo_clie) 
WHERE venta.id_vta = " . $_REQUEST["idvta"] . " limit 1;";



  	$result = $conn->query($sql);
    $c_nombre = "";
	$c_apaterno = "";
	$c_amaterno = "";
	$c_calle = "";
	$c_ne = "";
	$c_colonia = "";
	$c_cp = "";
	$c_municipio = "";
	$c_estado = "";
	$c_rfc = "";
	$c_factura = "";
	$c_sucursal = "";
	$c_venta = "";
	$c_fecha = "";
	$clave = 0;

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
		$c_nombre = $row["nom_clie"];
		$c_apaterno = $row["ap_clie"];  
		$c_amaterno = $row["am_clie"]; 
		$c_calle = $row["calle_clie"];
		$c_ne = $row["ne_clie"];
		$c_colonia = $row["col_clie"];
		$c_cp = $row["cp_clie"];
		$c_municipio = $row["nom_mun"];
		$c_estado = $row["nom_est"];
		$c_rfc = $row["rfc_clie"];
		$c_factura = $row["fol_fac"];
		$c_sucursal = $row["nom_suc"];
		$c_venta = $row["id_vta"];
		$c_fecha = $row["fec_vta"];
    }
  } else {
    echo "0 results";
  }
$content2="";
  $carrito = $_SESSION["sCarrito"];

	$cuentaCarrito = count($carrito);

	$TotalCompra = 0;

		include("./admin/conexion.php");

		$sql = " SELECT  auto.id_aut, prec_aut, nom_aut, modelo.nom_mod ,inv_vta.cant_prod, inventario.id_inv FROM auto 
		INNER JOIN modelo ON auto.id_mod = modelo.id_mod
		INNER JOIN inventario ON inventario.id_aut = auto.id_aut 
		INNER JOIN sucursal ON inventario.id_suc = sucursal.id_suc
        INNER JOIN inv_vta on inv_vta.id_inv = inventario.id_inv
		WHERE inv_vta.id_vta = " . $_REQUEST["idvta"] ;

	

		$result = $conn->query($sql);

		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$clave = ($row["id_aut"]);
				$nombreauto = ($row["nom_aut"]);
				$nombremodelo = ($row["nom_mod"]);
				$precioauto = ($row["prec_aut"]);
				$TotalCompra += ($row["prec_aut"] * $row["cant_prod"]);
				
				$content2 .= '<tr>
									<td >
									' . $clave . '
									</td>
									<td  >
									' . $nombreauto . '
									</td>
									<td >
									' . $nombremodelo . '
									</td>
									<td >
									$' . number_format($precioauto,2, '.',',') . '  
									</td>
									<td >
									' .  $row["cant_prod"] . '
									</td>
									<td  >
									' .  number_format($precioauto * $row["cant_prod"],2, '.',',') . '
									</td>
							  </tr>
						 ';
				
				}
		}





$content1 = '<html>
<body>
	<div>
		<div style="width: 120mm; text-align: center;"><h1>Factura</h1></div>
		<br><br><br>
		
		<h4>Emisor: Comercializadora de Autos Online SA de CV.</h4>
		
		<p>RFC:XAXX010101000<br>
		Avenida Camino Real #169, Col. Colinas del Sur, Corregidora, QRO. CP 76903<br>
		</p>
		<hr>
		<h4>Receptor: '. $c_nombre. ' '. $c_apaterno. ' ' .$c_amaterno .'</h4>
		<p>RFC: ' . $c_rfc . '<br>
		' . $c_calle . ' N° ' . $c_ne . ', ' . $c_municipio . ', ' . $c_estado . ', CP ' . $c_cp . '<br>
		<br></p>
		<hr>
		<h5>Factura: ' . $c_factura . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sucursal: ' . $c_sucursal . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Venta No. ' . $c_venta . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha: ' . $c_fecha . '</h5>
		<hr>
	</div>

  
     <div>
		<table >
			<tr>
				<th style="width:100">
					Clave 
				</th>
				<th style="width:150">
					Nombre 
				</th>
				<th style="width:150">
					Modelo 
				</th>
				<th style="width:180">
					Precio 
				</th>
				<th style="width:100">
					Cantidad 
				</th>
				<th style="width:180">
					Importe 
				</th>

			</tr>';
			
					
		

		
$content3 = '<strong>
			<tr style="border-top: 1px solid black;">
			<td></td>
				<td></td>
				<td style="text-align: right; ">
					Subtotal: 
				</td>
				<td style="text-align: right;">
				$' . number_format($TotalCompra, 2, '.', ',') . '
				</td>
			</tr>

			<tr>
			<td></td>
				<td></td>
				<td style="text-align: right; ">
					IVA: 
				</td>
				<td style="text-align: right;">
				$' . number_format($TotalCompra * 0.16, 2, '.', ',') . '
				</td>
			</tr>

			
			<tr>
			<td></td>
			<td></td>
				<td style="text-align: right; ">
					Total: 
				</td>
				<td style="text-align: right;">
				$' . number_format($TotalCompra*1.16, 2, '.', ',') . '
				</td>
			</tr>
			</strong>
		</table>
		<br><br><br>
		<div style="text-align: right;">
		</div>
	</div>
</body>

</html>';


$content = $content1 . $content2 . $content3;


try {
	ob_start();


	$html2pdf = new Html2Pdf('P', 'A4', 'es');
	$html2pdf->writeHTML($content);
	$html2pdf->output('example06.pdf');
} catch (Html2PdfException $e) {
	$html2pdf->clean();

	$formatter = new ExceptionFormatter($e);
	echo $formatter->getHtmlMessage();
}