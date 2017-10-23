
<?php

require_once '../../../config.php';

use Control\ControlCarreras;
use Control\Funciones;
use Objetos\Carrera;

if( !isset($_POST['career_register']) ){
    Funciones::makeJsonResponse(
        "registerCareer",
        'error',
        "No se envío la información esperada"
    );
    exit;
}
$conCareer = new ControlCarreras();

//JSON to JSON PHP Object
$json = $_POST['career_register'];
$registerCareerJSON= json_decode($json);

//Crear ciclo
$careerObj = new Carrera();
$careerObj->setName($registerCareerJSON->name);
$careerObj->setShortName($registerCareerJSON->short_name);

//Inserción un nuevo
// REGRESA UN ARRAY [RESULT,MESSAGE]
$result = $conCareer->insertCarrers($careerObj);

//--------Ocurrio un error
if( $result['result'] === 'error' ){
    echo Funciones::makeJsonResponse(
        "registerCareer",
        'error',
        $result['message']
    );
}

//--------Algun valor ya existe
if( $result['result'] === false ){

    echo Funciones::makeJsonResponse(
        "registerCareer",
        false,
        $result['message']
    );
}

//--------OK
if ($result['result'] === true){
    //TODO: enviar correo a admin
    //TODO: enviar correo de verificacion al usuario para que pueda inciiar sesion
    echo Funciones::makeJsonResponse(
        "registerCareer",
        true,
        $result['message']
    );

}
?>