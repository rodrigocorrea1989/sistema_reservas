<?php

include("header.php"); 

include("conn.php"); 

$registrosPorPagina = 10;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $registrosPorPagina;


?>

<div class="container mt-5">
    <h3 class="text-primary">Lista de Reservas</h3>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Número de habitación</th>
      <th scope="col">Cliente</th>
      <th scope="col">Descripción de la habitación</th>
      <th scope="col">Fecha De Check-in</th>
      <th scope="col">Fecha De Check-out</th>
   
    </tr>
  </thead>
  <tbody>
    <?php
       $sql="SELECT * FROM reservaciones ORDER BY CHECKIN DESC LIMIT $inicio, $registrosPorPagina";

       if($resultado=mysqli_query($conn,$sql)){

       while($registro=mysqli_fetch_assoc($resultado)){

        $NUM_HAB=$registro["NUM_HAB"];  

        $ID_CLIENTE=$registro["ID_CLIENTE"]; 

        $CHECKIN=date("d-m-Y H:i:s", strtotime($registro["CHECKIN"]));  

        $CHECKOUT=date("d-m-Y H:i:s", strtotime($registro["CHECKOUT"]));   

        $DESCRIPCION=" ";

            $sql_hab="SELECT * FROM habitaciones WHERE NUM_HAB='$NUM_HAB' ";

                if($resultado_hab=mysqli_query($conn,$sql_hab)){

                while($registro_hab=mysqli_fetch_assoc($resultado_hab)){

                    $DESCRIPCION=$registro_hab["DESCRIPCION"];  


                }

            }

            $sql_cli="SELECT * FROM clientes WHERE ID='$ID_CLIENTE' ";

                if($resultado_cli=mysqli_query($conn,$sql_cli)){

                while($registro_cli=mysqli_fetch_assoc($resultado_cli)){

                    $NOM_CLI=$registro_cli["NOM_CLI"];  

                    $APE_CLI=$registro_cli["APE_CLI"];  


                }

            }

    ?>

    <tr>
      <th scope="row"><?php echo $NUM_HAB ?></th>
      <th scope="row"><?php echo $NOM_CLI." ".$APE_CLI ?></th>
      <td><?php echo $DESCRIPCION ?></td>
      <td><?php echo $CHECKIN ?></td>
      <td><?php echo $CHECKOUT ?></td>
      
    </tr>
  

  <?php
       }

    }

  ?>
</tbody>
</table>

<?php

$sql_total = "SELECT COUNT(*) as total FROM reservaciones";
$resultado_total = mysqli_query($conn, $sql_total);
$fila_total = mysqli_fetch_assoc($resultado_total);
$totalRegistros = $fila_total['total'];
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Mostrar enlaces de paginación

for ($i = 1; $i <= $totalPaginas; $i++) {
    echo "|<a href='listas_reservas.php?pagina=$i'>$i</a> | ";
}

if(!isset($_GET['pagina'])){

    $pag=1;

}else{

  $pag=$_GET['pagina'];  

}

echo "Página: ".$pag;


?>

</div>

<?php



include("footer.php"); 

?>