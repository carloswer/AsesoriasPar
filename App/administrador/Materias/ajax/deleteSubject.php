
<?php

require_once '../../../config.php';

use Control\ControlMaterias;
use Control\Funciones;
use Objetos\Materia;

if( !isset($_POST['subject_delete']) ){
    Funciones::makeJsonResponse(
        "subjectCareer",
        'error',
        "No se envío la información esperada"
    );
    exit;
}
$conSubject = new ControlMaterias();

//JSON to JSON PHP Object
$json = $_POST['subject_delete'];
$deleteSubjectJSON= json_decode($json);

//Crear ciclo
$subjectObj = new Materia();
$subjectObj ->setId($deleteSubjectJSON->id);

//Inserción un nuevo
// REGRESA UN ARRAY [RESULT,MESSAGE]
$result = $conSubject->deleteSubject($subjectObj);

//--------Ocurrio un error
if( $result['result'] === 'error' ){
    echo Funciones::makeJsonResponse(
        "deleteSubject",
        'error',
        $result['message']
    );
}

//--------Algun valor ya existe
if( $result['result'] === false ){

    echo Funciones::makeJsonResponse(
        "deleteSubject",
        false,
        $result['message']
    );
}

//--------OK
if ($result['result'] === true){
    //TODO: enviar correo a admin
    //TODO: enviar correo de verificacion al usuario para que pueda inciiar sesion
    echo Funciones::makeJsonResponse(
        "deleteSubject",
        true,
        $result['message']
    );
}
?>