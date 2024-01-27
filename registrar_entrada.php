<?php

include("conn.php");

include("header.php");

?>

<div class="container mt-5">

    <h3 class="text-primary">Registrar Entrada</h3>

    <div class="card">
        <div class="card-body">
        <form action="proc_registrar_entrada.php" method="post">
        <div class="row">
            <div class="col-sm">
            <div class="form-group"><br>
                <label for="exampleFormControlFile1">ingrese número de habitación</label>
                <input class="form-control form-control-lg" type="text" name="num_hab" required>
                <label for="exampleFormControlSelect1">Cliente</label>
                    <select class="form-control" name="cliente" id="exampleFormControlSelect1">
                        <?php
                        $sql="SELECT * FROM clientes ";

                        if($resultado=mysqli_query($conn,$sql)){
                 
                            while($registro=mysqli_fetch_assoc($resultado)){

                                $NOM_CLI=$registro["NOM_CLI"];

                                $APE_CLI=$registro["APE_CLI"];

                                $ID=$registro["ID"];

                        ?>
                        <option value="<?php echo $ID ?>"><?php echo $NOM_CLI." ".$APE_CLI ?></option>
                        <?php

                                }

                            }

                        ?>
                    </select>
            </div>
            </div>
        <div class="col-sm">
            <div class="form-group">
                <label for="exampleFormControlFile1">ingrese fecha de check-in</label><br>
                fecha:<input class="form-control form-control-lg" type="date" name="f_checkin" required>
                hora:<input class="form-control form-control-lg" type="time" name="h_checkin" required>
            </div>
        </div>
        <div class="col-sm">
        <div class="form-group">
                <label for="exampleFormControlFile1">ingrese fecha de check-out</label><br>
                fecha:<input class="form-control form-control-lg" type="date" name="f_checkout" required>
                hora:<input class="form-control form-control-lg" type="time" name="h_checkout" required>
            </div>
        </div>
    </div>
            
            <button class="btn btn-primary">Registrar</button>
        </form>
        </div>
    </div>
  
</div>


<?php

include("footer.php");

?>