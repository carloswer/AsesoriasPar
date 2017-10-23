
<?php

require_once '../../../config.php';

use Control\ControlCiclos;
use Control\Funciones;
use Objetos\Ciclo;

if( !isset($_POST['cycle_delete'])){
    Funciones::makeJsonResponse(
        "deleteCycle",
        'error',
        "No se envío la información esperada"
    );
    exit;
}
$conCycles = new ControlCiclos();

//JSON to JSON PHP Object
$json = $_POST['cycle_delete'];
$deleteCycleJSON= json_decode($json);

//Crear ciclo
$cycleObj = new Ciclo();
$cycleObj->setId(($deleteCycleJSON->id));

//Inserción un nuevo
$result = $conCycles->deleteCycles($cycleObj);

//--------Ocurrio un error
if( $result['result'] === 'error' ){
    echo Funciones::makeJsonResponse(
        "deleteCycle",
        'error',
        $result['message']

    );
}

//--------Algun valor ya existe
if( $result['result'] == false ){

    echo Funciones::makeJsonResponse(
        "deleteCycle",
        false,
        $result['message']
    );
}

//--------OK
if ($result['result'] === true){
    //TODO: enviar correo a admin
    //TODO: enviar correo de verificacion al usuario para que pueda inciiar sesion
    echo Funciones::makeJsonResponse(
        "deleteCycle",
        true,
        "Eliminado con éxito"
    );

}




?>