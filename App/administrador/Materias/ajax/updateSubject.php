
<?php

require_once '../../../config.php';

use Control\ControlMaterias;
use Control\Funciones;
use Objetos\Materia;

if( !isset($_POST['subject_update']) ){
    Funciones::makeJsonResponse(
        "updateSubject",
        'error',
        "No se envío la información esperada"
    );
    exit;
}
$conSubject= new ControlMaterias();

//JSON to JSON PHP Object
$json = $_POST['subject_update'];
$updateSubjectJSON = json_decode($json);

//Crear ciclo
$subjectObj = new Materia();
$subjectObj -> setId($updateSubjectJSON ->id);
$subjectObj -> setName($updateSubjectJSON -> name);
$subjectObj -> setShortName($updateSubjectJSON -> short_name);
$subjectObj -> setDescription($updateSubjectJSON -> description);
$subjectObj -> setSemester($updateSubjectJSON -> semester);
$subjectObj -> setCareer($updateSubjectJSON -> career);
$subjectObj -> setSchoolPlan($updateSubjectJSON -> plan);

//Actualizacion
$result = $conSubject->updateSubject($subjectObj);

//--------Ocurrio un error
if( $result['result'] === 'error' ){
    echo Funciones::makeJsonResponse(
        "updateSubject",
        'error',
        $result['message']
    );
}

//--------Algun valor ya existe
if( $result['result'] === false ){

    echo Funciones::makeJsonResponse(
        "updateSubject",
        false,
        $result['message']
    );
}

//--------OK
if ($result['result'] === true){
    //TODO: enviar correo a admin
    //TODO: enviar correo de verificacion al usuario para que pueda inciiar sesion
    echo Funciones::makeJsonResponse(
        "updateSubject",
        true,
        $result['message']
    );
}
?>