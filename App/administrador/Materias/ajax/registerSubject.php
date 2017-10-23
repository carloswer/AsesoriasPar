
<?php

require_once '../../../config.php';

use Control\ControlMaterias;
use Control\Funciones;
use Objetos\Materia;

if( !isset($_POST['subject_register']) ){
    Funciones::makeJsonResponse(
        "registerSubject",
        'error',
        "No se envío la información esperada"
    );
    exit;
}
$conSubject = new ControlMaterias();

//JSON to JSON PHP Object
$json = $_POST['subject_register'];
$registerSubjectJSON = json_decode($json);

//Crear ciclo
$subjectObj = new Materia();
$subjectObj -> setName($registerSubjectJSON -> name);
$subjectObj -> setShortName($registerSubjectJSON -> short_name);
$subjectObj -> setDescription($registerSubjectJSON -> description);
$subjectObj -> setSemester($registerSubjectJSON -> semester);
$subjectObj -> setCareer($registerSubjectJSON -> career);
$subjectObj -> setSchoolPlan($registerSubjectJSON -> plan);

//Inserción un nuevo
// REGRESA UN ARRAY [RESULT,MESSAGE]
$result = $conSubject->insertSubject($subjectObj);

//--------Ocurrio un error
if( $result['result'] === 'error' ){
    echo Funciones::makeJsonResponse(
        "registerSubject",
        'error',
        $result['message']
    );
}

//--------Algun valor ya existe
if( $result['result'] === false ){

    echo Funciones::makeJsonResponse(
        "registerSubject",
        false,
        $result['message']
    );
}

//--------OK
if ($result['result'] === true){
    //TODO: enviar correo a admin
    //TODO: enviar correo de verificacion al usuario para que pueda inciiar sesion
    echo Funciones::makeJsonResponse(
        "registerSubject",
        true,
        $result['message']
    );

}
?>