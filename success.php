<?php

include("header.php");

include("conn.php");

$num_hab=htmlentities(addslashes($_GET["num_hab"]));

$sql="SELECT * FROM reservaciones WHERE NUM_HAB='$num_hab' ";

if($resultado=mysqli_query($conn,$sql)){

while($registro=mysqli_fetch_assoc($resultado)){

    $NUM_HAB=$registro["NUM_HAB"];  

    $CHECKIN=date("d-m-Y H:i:s", strtotime($registro["CHECKIN"]));  

    $CHECKOUT=date("d-m-Y H:i:s", strtotime($registro["CHECKOUT"])); 
     

}

}



?>
<div class="container mt-5">

    <h3 class="text-primary">Registro Entrada Exitosa</h3>

    <div class="card">
        <div class="card-body">
                <p class="text-primary">Número de habitación <?php echo $NUM_HAB ?></p><br>
                <p class="text-primary">Check-in <?php echo $CHECKIN ?></p><br>
                <p class="text-primary">Check-out <?php echo $CHECKOUT ?></p><br>
                <a class="btn btn-primary" href="registrar_entrada.php">Registrar Otra Entrada</a>
        </div>
    </div>            

</div>  

<?php

include("footer.php");

?>