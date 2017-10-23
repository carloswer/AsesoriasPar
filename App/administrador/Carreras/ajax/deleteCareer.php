
<?php

require_once '../../../config.php';

use Control\ControlCarreras;
use Control\Funciones;
use Objetos\Carrera;

if( !isset($_POST['career_delete']) ){
    Funciones::makeJsonResponse(
        "deleteCareer",
        'error',
        "No se envío la información esperada"
    );
    exit;
}
$conCareer = new ControlCarreras();

//JSON to JSON PHP Object
$json = $_POST['career_delete'];
$deleteCareerJSON= json_decode($json);

//Crear ciclo
$careerObj = new Carrera();
$careerObj->setId($deleteCareerJSON->id);

//Inserción un nuevo
// REGRESA UN ARRAY [RESULT,MESSAGE]
$result = $conCareer->deleteCareers($careerObj);

//--------Ocurrio un error
if( $result['result'] === 'error' ){
    echo Funciones::makeJsonResponse(
        "deleteCareer",
        'error',
        $result['message']
    );
}

//--------Algun valor ya existe
if( $result['result'] === false ){

    echo Funciones::makeJsonResponse(
        "deleteCareer",
        false,
        $result['message']
    );
}

//--------OK
if ($result['result'] === true){
    //TODO: enviar correo a admin
    //TODO: enviar correo de verificacion al usuario para que pueda inciiar sesion
    echo Funciones::makeJsonResponse(
        "deleteCareer",
        true,
        $result['message']
    );
}
?>