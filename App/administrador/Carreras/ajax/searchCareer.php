
<?php

require_once '../../../config.php';

use Control\ControlCarreras;
use Control\Funciones;
use Objetos\Carrera;

if( !isset($_POST['career_search']) ){
    Funciones::makeJsonResponse(
        "searchCareer",
        'error',
        "No se envío la información esperada"
    );
    exit;
}
$conCareer = new ControlCarreras();

//JSON to JSON PHP Object
$json = $_POST['career_search'];
$searchCareerJSON= json_decode($json);

//Crear ciclo
//$careerObj = new Carrera();
//$careerObj->setId($searchCareerJSON->toSearch);
$toSearch = $searchCareerJSON->toSearch;
$value = $searchCareerJSON->value;

// REGRESA UN ARRAY [RESULT,MESSAGE]
$result = $conCareer->searchCareers($toSearch,$value);

if( $result['result'] === false ){
    echo Funciones::makeJsonResponse(
        "searchCareer",
        'error',
        $result['message']
    );
}

if( $result['result'] === true ){

    echo Funciones::makeJsonResponse(
        "searchCareer",
        'true',
        $result['message']
    );
}

?>