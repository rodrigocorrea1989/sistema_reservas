<?php

include("header.php"); 

$num_hab=htmlentities(addslashes($_POST["num_hab"]));

$f_checkin=htmlentities(addslashes($_POST["f_checkin"]));

$h_checkin=htmlentities(addslashes($_POST["h_checkin"]));

$f_checkout=htmlentities(addslashes($_POST["f_checkout"]));

$h_checkout=htmlentities(addslashes($_POST["h_checkout"]));

$checkin_hab_c=$f_checkin." ".$h_checkin;

$checkout_hab_c=$f_checkout." ".$h_checkout;

$cliente=htmlentities(addslashes($_POST["cliente"]));


//Comprueba el número de habitación
comprobrar_existencia($num_hab);


//verifica que no se ingrese un valor de fecha menor al tiempo presente
comparar_fechaactual($checkin_hab_c , $checkout_hab_c);


//valida el formulario
validar($checkin_hab_c , $checkout_hab_c);


//funcion para comprobar disponibilidad
comprobar_disponibilidad($num_hab , $checkin_hab_c , $checkout_hab_c);

//ejecuta la reserva
registrar_reserva($num_hab , $checkin_hab_c , $checkout_hab_c , $cliente );



//función para incluir conexion
function incluir_conexion()
{

    include("conn.php");

    return $conn;

}


//verifica que no se ingrese un valor de fecha menor al tiempo presente
function comparar_fechaactual($checkin_hab_param , $checkout_hab_param)
{

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $fechaHoraActual = date("Y-m-d H:i:s");

    if($checkin_hab_param < $fechaHoraActual){
            
        echo "<div class='container mt-5'><h3 class='text-danger'>La fecha de check-in no debe ser menor a la fecha actual</h3>
        <a class='btn btn-primary' href='registrar_entrada.php'>Volver</a></div>";
        

        exit();


    }elseif($checkout_hab_param < $fechaHoraActual ){
            
        echo "<div class='container mt-5'><h3 class='text-danger'>La fecha de check-out no debe ser menor a la fecha actual</h3>
        <a class='btn btn-primary' href='registrar_entrada.php'>Volver</a></div>";
        

        exit();


    }



}


//cerifica que el valor de tipo date no sea mayot  al checkout
function validar($checkin_hab_param , $checkout_hab_param)
{

    if($checkin_hab_param > $checkout_hab_param){
            
        echo "<div class='container mt-5'><h3 class='text-danger'>La fecha de check-in no debe ser mayor al de check-out</h3>
        <a class='btn btn-primary' href='registrar_entrada.php'>Volver</a></div>";
        

        exit();



    }

}

//Comprueba el número de habitación
function comprobrar_existencia($num_hab_param)
{

    $conn=incluir_conexion();    

    $token=0;

    $sql="SELECT * FROM habitaciones WHERE NUM_HAB='$num_hab_param'";

       if($resultado=mysqli_query($conn,$sql)){

       while($registro=mysqli_fetch_assoc($resultado)){

        $token++;

       }

    }

    mysqli_close($conn);

    if($token==0){

        echo "<div class='container mt-5'><h3 class='text-danger'>Número de habitación incorrecto</h3>
        <a class='btn btn-primary' href='registrar_entrada.php'>Volver</a></div>";
        

        exit();
    }


}


//funcion para comprobar disponibilidad
function comprobar_disponibilidad($num_hab_param, $checkin_hab_param , $checkout_hab_param)
{

    $conn=incluir_conexion(); 

    $sql="SELECT * FROM reservaciones WHERE NUM_HAB='$num_hab_param' ORDER BY CHECKIN ASC";

       if($resultado=mysqli_query($conn,$sql)){

       while($registro=mysqli_fetch_assoc($resultado)){

        $CHECKIN=$registro["CHECKIN"];  

        $CHECKOUT=$registro["CHECKOUT"];  

        if($checkin_hab_param <  $CHECKIN &&  $checkout_hab_param >  $CHECKIN    ){

            
            echo "<div class='container mt-5'><h3 class='text-danger'>Fecha no disponible para el checkout</h3>
            <a class='btn btn-primary' href='registrar_entrada.php'>Volver</a></div>";

            exit();

        }elseif($checkin_hab_param >  $CHECKIN &&  $checkin_hab_param <  $CHECKOUT){

            echo "<div class='container mt-5'><h3 class='text-danger'>La habitación no esta disponible en su rango de fecha, 
            por favor comuniquese con el administrador</h3>
            <a class='btn btn-primary' href='registrar_entrada.php'>Volver</a></div>";

            exit();

        }

        }

       }

    mysqli_close($conn);

}


//funcion para procesar el registro de reserva
 function registrar_reserva($num_hab_param , $checkin_hab_param , $checkou_hab_param , $cliente_param )
 {

    $conn=incluir_conexion();

    $sql="INSERT INTO reservaciones (NUM_HAB , CHECKIN , CHECKOUT, ID_CLIENTE) VALUES ('$num_hab_param' ,'$checkin_hab_param' , '$checkou_hab_param' , '$cliente_param')";

    mysqli_query($conn,$sql);

    mysqli_close($conn);

    header("location:success.php?num_hab=".$num_hab_param);
}



?>

<?php



include("footer.php");

?>