
<?php

require_once '../../../config.php';

use Control\ControlCarreras;
use Control\Funciones;
use Objetos\Carrera;

if( !isset($_POST['career_update']) ){
    Funciones::makeJsonResponse(
        "updateCareer",
        'error',
        "No se envío la información esperada"
    );
    exit;
}
$conCareer = new ControlCarreras();

//JSON to JSON PHP Object
$json = $_POST['career_update'];
$updateCareerJSON= json_decode($json);

//Crear ciclo
$careerObj = new Carrera();
$careerObj->setId($updateCareerJSON->id);
$careerObj->setName($updateCareerJSON->name);
$careerObj->setShortName($updateCareerJSON->short_name);

//Inserción un nuevo
// REGRESA UN ARRAY [RESULT,MESSAGE]
$result = $conCareer->updateCarrers($careerObj);

//--------Ocurrio un error
if( $result['result'] === 'error' ){
    echo Funciones::makeJsonResponse(
        "updateCareer",
        'error',
        $result['message']
    );
}

//--------Algun valor ya existe
if( $result['result'] === false ){

    echo Funciones::makeJsonResponse(
        "updateCareer",
        false,
        $result['message']
    );
}

//--------OK
if ($result['result'] === true){
    //TODO: enviar correo a admin
    //TODO: enviar correo de verificacion al usuario para que pueda inciiar sesion
    echo Funciones::makeJsonResponse(
        "updateCareer",
        true,
        $result['message']
    );
}
?>