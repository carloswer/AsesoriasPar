<?php namespace Control;

use Modelo\Persistencia\Materias;
use Objetos\Materia;

class ControlMaterias{

    private $perSubject;

    public function __construct(){
        $this->perSubject = new Materias();
    }

    /**
     * @param $mat
     * @return Materia
     */
    private static function makeObject_Subject( $mat ){

        $materia = new Materia();
        $materia->setId($mat['id']);
        $materia->setName($mat['name']);
        $materia->setShortName($mat['short_name']);
        $materia->setDescription($mat['description']);
        $materia->setSchoolPlan($mat['plan']);
        $materia->setSemester($mat['semester']);

        $conCareers = new ControlCarreras();
        $career = $conCareers->getCareer_ById( $mat['career_id'] );
        $materia->setCareer( $career );
        //Se regresa
        return $materia;
    }

    /**
     * @return array|null|string
     */
    public function getSubjects(){
        $result = $this->perSubject->getSubjects();
        if( $result === false ){
            return 'error';
        }
        else if( $result === null ){
            return null;
        }
        else{
            $array = array();
            foreach( $result as $materia ) {
                //Se agrega al array
                $array[] = self::makeObject_Subject($materia);
            }
            return $array;
        }
    }


    /**
     * @param $subject
     * @return array
     */
    public function insertSubject( $subject ){

        $name = $subject->getName();
        $short_name = $subject->getShortName();

        //Verificamos que la carrera no exista
        //REGRESA TRUE O FALSE

        $result = $this->isSubjectExist_ByName($subject);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener materia por el nombre"
            ];
            return $response;
        }

        else if( $result === true ) {
            $response = [
                "result" => false,
                "type" => "career",
                "message" => "Materia ya existe",
            ];
            return $response;
        }

//        Verificamos si el shortname ya existe

        $result = $this->isSubjectExist_ByShort_name($subject);

        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener materia por la abreviatura"
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
        $result = $this->perSubject->insertSubject( $subject );

        if( $result === false ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo registrar la materia"
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

    //--------------------UPDATE SUBJECT--------------------

    /**
     * @param $subject
     * @return array
     */
    public function updateSubject( $subject ){

        $id = $subject->getId();

        //Verificamos si la materia existe
        //REGRESA TRUE O FALSE

        $result = $this->isSubjectExist_ById($id);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "type" => "subject",
                "message" => "No se pudo obtener materia por el ID"
            ];
            return $response;
        }

        else if( $result === false ) {
            $response = [
                "result" => false,
                "type" => "subject",
                "message" => "Materia no existe",
            ];
            return $response;
        }

        $result = $this->isSubjectExist_ByName($subject);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener materia por el Nombre"
            ];
            return $response;
        }

        else if( $result === true ) {
            $response = [
                "result" => false,
                "type" => "subject",
                "message" => "Nombre ya existe",
            ];
            return $response;
        }

//        Verificamos si el shortname ya existe
        //TRUE O FALSE
        $result = $this->isSubjectExist_ByShort_name($subject);

        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener materia por la abreviatura"
            ];
            return $response;

        }else if( $result === true ) {
            $response = [
                "result" => false,
                "type" => "subject",
                "message" => "Abreviatura ya existe",
            ];
            return $response;
        }

        // Si sale bien, Inicia registro de Carrera
        $result = $this->perSubject->updateSubject( $subject);

        if( $result === false ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo actualizar la materia"
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

    //---------------------DELETE SUBJECT--------------------

    /**
     * @param $career
     * @return array
     */
    public function deleteSubject( $subject ){

        $id = $subject->getId();

        //Verificamos si la carrera existe
        //REGRESA TRUE O FALSE
        $result = $this->isSubjectExist_ById($id);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "type" => "subject",
                "message" => "No se pudo obtener materia por el ID"
            ];
            return $response;
        }

        else if( $result === false ) {
            $response = [
                "result" => false,
                "type" => "subject",
                "message" => "Materia no existe",
            ];
            return $response;
        }

        // Si sale bien, se elimina de Materia
        $result = $this->perSubject->deleteSubject( $subject );

        if( $result === false ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo eliminar la materia"
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
     * @param $toSearch
     * @param $value
     * @return array
     */
    public function searchSubject( $toSearch, $value ){
        $table="";

        // Busqueda por ID
        if($toSearch == "id"){
            //Obtiene la carrera por el id
            $result = $this->getSubject_ById($value);

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

            // BUSQUEDA POR NOMBRE
        } else if($toSearch == "name"){
            $result = $this->getSubject_ByNameSearch($value);

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

            // BUSQUEDA POR ABREVIATURA
        }else if($toSearch == "shortName") {
            $result = $this->getSubject_ByShort_nameSearch($value);

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

            // BUSQUEDA POR CARRERA
        }else if ($toSearch == "career"){
            $result = $this->getSubject_ByCareer( $value );

            if($result === false){
                $response = [
                    "result" => false,
                    "message" => "No se encontraron coincidencias con la carrera que ingreso."
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

            // BUSQUEDA POR PLAN EDUACTIVO
        } else if ($toSearch == "plan"){
            $result = $this->getSubject_ByPlan( $value );

            if($result === false){
                $response = [
                    "result" => false,
                    "message" => "No se encontraron coincidencias con el plan que ingreso."
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

            // BUSQUEDA POR SEMESTRE
        } else if ($toSearch == "semester"){
            $result = $this->getSubject_BySemester( $value );

            if($result === false){
                $response = [
                    "result" => false,
                    "message" => "No se encontraron coincidencias con el semestre que ingreso."
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




    /**
     * @param $name
     * @return array|bool|null|string
     */
    public function isSubjectExist_ByName( $subject )
    {
        $result = $this->getSubject_ByName( $subject );
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
     * @param $name
     * @return array|bool|string
     */
    public function getSubject_ByName( $subject )
    {
        $result = $this->perSubject->getSubject_ByName( $subject );

        if( $result === 'error'){
            return 'error';
        }
        else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $subject ){
                $array[] = self::makeObject_Subject($subject);
            }
            return $array;

        }
    }

    /**
     * @param $name
     * @return array|bool|string
     */
    public function getSubject_ByNameSearch( $subject )
    {
        $result = $this->perSubject->getSubject_ByNameOnSearch( $subject );

        if( $result === 'error'){
            return 'error';
        }
        else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $subject ){
                $array[] = self::makeObject_Subject($subject);
            }
            return $array;

        }
    }

    /**
     * @param $subject
     * @return bool|null|string
     */
    public function isSubjectExist_ByShort_name( $subject )
    {
        $result = $this->getSubject_ByShort_name( $subject );

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
     * @param $subject
     * @return array|bool|string
     */
    public function getSubject_ByShort_name( $subject )
    {
        $result = $this->perSubject->getSubject_ByShort_name( $subject );

        if( $result === 'error' ){
            return 'error';
        } else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $subject ){
                $array[] = self::makeObject_Subject($subject);
            }
            return $array;
        }
    }

    /**
     * @param $subject
     * @return array|bool|string
     */
    public function getSubject_ByShort_nameSearch( $subject )
    {
        $result = $this->perSubject->getSubject_ByShortNameOnSearch( $subject );

        if( $result === 'error' ){
            return 'error';
        } else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $subject ){
                $array[] = self::makeObject_Subject($subject);
            }
            return $array;
        }
    }

    /**
     * @param $subject
     * @return array|bool|string
     */
    public function getSubject_ByCareer( $subject )
    {
        $result = $this->perSubject->getSubject_ByCareer( $subject );

        if( $result === 'error' ){
            return 'error';
        } else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $subject ){
                $array[] = self::makeObject_Subject($subject);
            }
            return $array;
        }
    }

    public function getSubject_ByPlan( $subject )
    {
        $result = $this->perSubject->getSubject_ByPlan( $subject );

        if( $result === 'error' ){
            return 'error';
        } else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $subject ){
                $array[] = self::makeObject_Subject($subject);
            }
            return $array;
        }
    }

    public function getSubject_BySemester( $subject )
    {
        $result = $this->perSubject->getSubject_BySemester( $subject );

        if( $result === 'error' ){
            return 'error';
        } else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $subject ){
                $array[] = self::makeObject_Subject($subject);
            }
            return $array;
        }
    }



    /**
     * @param $id
     * @return bool|null
     */
    public function isSubjectExist_ById( $id )
    {
        $result = $this->getSubject_ById( $id );
        if( $result === 'error' )
            return $result;
        else if( $result === null )
            return null;
        else if( $result === false ){
            return false;
        }
        return true;
    }

    public function getSubject_ById($id)
    {
        $result = $this->perSubject->getSubjects_ById($id);
        if( $result === 'error' ){
            return 'error';
        } else if( $result === null )
            return false;
        else{
            $array = array();
            foreach( $result as $subject ){
                $array[] = self::makeObject_Subject($subject);
            }
            return $array;

        }
    }
}
?>