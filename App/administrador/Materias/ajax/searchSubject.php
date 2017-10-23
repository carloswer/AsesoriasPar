
<?php

require_once '../../../config.php';

use Control\ControlMaterias;
use Control\Funciones;
use Objetos\Materia;

if( !isset($_POST['subject_search']) ){
    Funciones::makeJsonResponse(
        "searchSubject",
        'error',
        "No se envío la información esperada"
    );
    exit;
}
$conSubject = new ControlMaterias();

//JSON to JSON PHP Object
$json = $_POST['subject_search'];
$searchSubjectJSON = json_decode($json);

//Crear ciclo
//$careerObj = new Carrera();
$toSearch = $searchSubjectJSON->toSearch;
$value = $searchSubjectJSON->value;

// REGRESA UN ARRAY [RESULT,MESSAGE]
$result = $conSubject->searchSubject ($toSearch,$value);

if( $result['result'] === false ){
    echo Funciones::makeJsonResponse(
        "searchSubject",
        'error',
        $result['message']
    );
}

if( $result['result'] === true ){

    echo Funciones::makeJsonResponse(
        "searchSubject",
        'true',
        $result['message']
    );
}

?>