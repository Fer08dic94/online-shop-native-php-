<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style>
body {
  background-image: url('../admin/dist/uploadImgs/sunset2.png');
}
</style>


    <script type="text/javascript">
        $(document).ready(function(){
            $("#id_estado").change(function(){
                var id_estado = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "ajaxDatos.php",
                        //data: {"id_estado=": id_estado},
                        data:'id_estado=' + id_estado,
                        success: function(html){
                            console.log(html);
                            $("#id_municipio").html(html);
                        }
                    });
                
            });
        });
    </script>
</head>
<body>

<div style="margin-top:25px;" class="container">

<div class="col-md-4"> 
    <select class="form-control col-md-4" name="estado" id="id_estado">
        <option value="">Selecciona un estado</option>
        <?php 

            include('conexion.php');

            $sql = "SELECT * FROM estado";
            echo $sql;
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
            
                echo "
                    <option value='". $row["id_est"] . "'>"  .  $row["nom_est"] . "</option>";

            }
            } else {
            echo "0 results";
            }
           
        
        ?>
    </select>
</div>

<div class="col-md-4"> 
    <select class="form-control col-md-4" name="id_municipio" id="id_municipio">
        <option value="">Selecciona un municipio</option>
    </select>

</div>

</div>





</body>
</html>




