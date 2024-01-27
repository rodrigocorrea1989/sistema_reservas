<?php

include("header.php"); 

include("conn.php"); 

$registrosPorPagina = 10;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $registrosPorPagina;


?>

<div class="container mt-5">
    <h3 class="text-primary">Habitaciones</h3>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Número de habitación</th>
      <th scope="col">Descripcion</th>
     
   
    </tr>
  </thead>
  <tbody>
    <?php
       $sql="SELECT * FROM habitaciones LIMIT $inicio, $registrosPorPagina";

       if($resultado=mysqli_query($conn,$sql)){

       while($registro=mysqli_fetch_assoc($resultado)){

        $NUM_HAB=$registro["NUM_HAB"];  

        $DESCRIPCION=$registro["DESCRIPCION"]; 

    ?>

    <tr>
      <th scope="row"><?php echo $NUM_HAB ?></th>
      <td><?php echo $DESCRIPCION ?></td>
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