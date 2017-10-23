<?php namespace Control;

use Modelo\Persistencia\Carreras;
use Objetos\Carrera;

class ControlCarreras{

    private $perCareers;

    public function __construct(){
        $this->perCareers = new Carreras();
    }

    /**
     * @param $c array
     * @return Carrera
     */
    public static function makeObject_career( $c ){
        $career = new Carrera();
        $career->setId( $c['id'] );
        $career->setName( $c['name'] );
        $career->setShortName( $c['short_name'] );
        $career->setDate( $c['date'] );
        return $career;

    }

    /**
     * @param $id
     * @return null|Carrera|string
     */
    public function getCareer_ById( $id ){

        $result = $this->perCareers->getCareer_ById($id);
        if( $result === 'error' ){
            return 'error';
        } else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $career ){
                $array[] = self::makeObject_career($career);
            }
            return $array;

        }
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function isCareerExist_ById($id ){

        $result = $this->getCareer_ById($id);
        if( $result === 'error' )
            return $result;
        else if( $result === null )
            return null;
        else if( $result === false ){
            return false;
        }
        return true;
    }

    /**
     * @return array|null|string
     */
    public function getCareers(){

        $result = $this->perCareers->getCareers();
        if( $result === false ){
            return 'error';
        }
        else if( $result === null )
            return null;
        else{
            $array = array();
            foreach( $result as $career ){
                $array[] = self::makeObject_career($career);
            }
            return $array;
        }
    }

    /**
     * @param $name
     * @return null|Carrera|string
     */
    public function getCareer_ByName( $name ){

        $result = $this->perCareers->getCareer_ByName ($name );

        if( $result === 'error'){
            return 'error';
        }
        else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $career ){
                $array[] = self::makeObject_career($career);
            }
            return $array;

        }
    }

    /**
     * @param $short_name
     * @return null|Carrera|string
     */
    public function getCareer_ByShort_Name( $short_name ){
        //NULL O ARRAY
        $result = $this->perCareers->getCareer_ByShort_name( $short_name );

        if( $result === 'error' ){
            return 'error';
        } else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $career ){
                $array[] = self::makeObject_career($career);
            }
            return $array;
        }

    }

    /**
     * @param $name
     * @return bool
     */
    public function isCareerExist_ByName( $name ){

        $result = $this->getCareer_ByName($name);
        if( $result === 'error' )
            return $result;
        else if( $result === null )
            return null;
        else if ( $result === false ){
            return false;
        }
        return true;
    }

    /**
     * @param $short_name
     * @return bool
     */
    public function isCareerExist_ByShort_name( $short_name ){

        $result = $this->getCareer_ByShort_name( $short_name );

        if( $result === 'error' )
            return 'error';
        else if( $result === null ){
            return null;
        } else if ($result === false){
            return false;
        }
        return true;
    }


    /**
     * @param $career
     * @return array
     */
    public function insertCarrers( $career ){

        $name = $career->getName();
        $short_name = $career->getShortName();

        //Verificamos que la carrera no exista
        //REGRESA TRUE O FALSE

        $result = $this->isCareerExist_ByName($name);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener carrera por el nombre"
            ];
            return $response;
        }

        else if( $result === true ) {
            $response = [
                "result" => false,
                "type" => "career",
                "message" => "Carrera ya existe",
            ];
            return $response;
        }

//        Verificamos si el shortname ya existe

        $result = $this->isCareerExist_ByShort_name($short_name);

        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener carrera por el Shor_Name"
            ];
            return $response;
        }

        else if( $result === true ) {
            $response = [
                "result" => false,
                "type" => "career",
                "message" => "Abreviatura ya existe",
            ];
            return $response;
        }

        // Si sale bien, Inicia registro de Carrera
        $result = $this->perCareers->insertCareer( $career );

        if( $result === false ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo registrar la carrera"
            ];
            return $response;
        }

        //Si sale bien
        $response = [
            "result" => true,
            "message" => "Se registro correctamente"
        ];
        return $response;


    }

    /**
     * @param $career
     * @return array
     */
    public function updateCarrers( $career ){

        $id = $career->getId();
        $name = $career->getName();
        $short_name = $career->getShortName();

        //Verificamos si la carrera existe
        //REGRESA TRUE O FALSE

        $result = $this->isCareerExist_ById($id);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "type" => "career",
                "message" => "No se pudo obtener carrera por el ID"
            ];
            return $response;
        }

        else if( $result === false ) {
            $response = [
                "result" => false,
                "type" => "career",
                "message" => "Carrera no existe",
            ];
            return $response;
        }

        $result = $this->isCareerExist_ByName($name);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener carrera por el Nombre"
            ];
            return $response;
        }

        else if( $result === true ) {
            $response = [
                "result" => false,
                "type" => "career",
                "message" => "Nombre ya existe",
            ];
            return $response;
        }

//        Verificamos si el shortname ya existe
        //TRUE O FALSE
        $result = $this->isCareerExist_ByShort_name($short_name);

        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener carrera por la abreviatura"
            ];
            return $response;

        }else if( $result === true ) {
            $response = [
                "result" => false,
                "type" => "career",
                "message" => "Abreviatura ya existe",
            ];
            return $response;
        }

        // Si sale bien, Inicia registro de Carrera
        $result = $this->perCareers->updateCareer( $career );

        if( $result === false ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo actualizar la carrera"
            ];
            return $response;
        }

        //Si sale bien
        $response = [
            "result" => true,
            "message" => "Se actualizo correctamente"
        ];
        return $response;
    }

    /**
     * @param $career
     * @return array
     */
    public function deleteCareers( $career ){

        $id = $career->getId();

        //Verificamos si la carrera existe
        //REGRESA TRUE O FALSE
        $result = $this->isCareerExist_ById($id);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "type" => "career",
                "message" => "No se pudo obtener carrera por el ID"
            ];
            return $response;
        }

        else if( $result === false ) {
            $response = [
                "result" => false,
                "type" => "career",
                "message" => "Carrera no existe",
            ];
            return $response;
        }

        // Si sale bien, se elimina de Carrera
        $result = $this->perCareers->deleteCareer( $career );

        if( $result === false ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo eliminar la carrera"
            ];
            return $response;
        }

        //Si sale bien
        $response = [
            "result" => true,
            "message" => "Se elimino correctamente"
        ];
        return $response;
    }

    /**
     * @param $career
     * @return array
     */
    public function searchCareers( $toSearch, $value ){
        $table="";

        // Busqueda por ID
        if($toSearch == "id"){
            //Obtiene la carrera por el id
            $result = $this->getCareer_ById($value);

            //Si no se encontraron resultados
            if( $result === false ){
                $response = [
                    "result" => false,
                    "message" => "No se encontraron coincidencias con el ID ingresado."
                ];
                return $response;
                //Si es diferente de null
            }else if($result != null){
                //Construye la tabla
                $table = Funciones::makeSearchTable($result);

                //Si sale bien
                $response = [
                    "result" => true,
                    "message" => "$table"
                ];

                return $response;
            }

        } else if($toSearch == "name"){
            $result = $this->getCareer_ByName($value);

            if( $result === false ){
                $response = [
                    "result" => false,
                    "message" => "No se encontraron coincidencias con el Nombre ingresado."
                ];
                return $response;

            }else if($result != null){

                $table = Funciones::makeSearchTable($result);

                //Si sale bien
                $response = [
                    "result" => true,
                    "message" => "$table"
                ];

                return $response;
            }

        }else if($toSearch == "shortName") {
            $result = $this->getCareer_ByShort_Name($value);

            if( $result === false ){
                $response = [
                    "result" => false,
                    "message" => "No se encontraron coincidencias con la abreviatura que ingreso."
                ];
                return $response;

            }else if($result != null){
                $table = Funciones::makeSearchTable($result);

                //Si sale bien
                $response = [
                    "result" => true,
                    "message" => "$table"
                ];

                return $response;
            }
        }
    }
}