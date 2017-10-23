<?php namespace Modelo\Persistencia;

    use Objetos\Estudiante;

    class Estudiantes extends Persistencia{

        public function __construct(){}


        private $campos = "SELECT
                        e.PK_id as 'id_student', 
                        e.id_itson as 'id_itson', 
                        e.nombre as 'first_name', 
                        e.apellido as 'last_name', 
                        e.telefono as 'phone', 
                        e.facebook as 'facebook', 
                        e.avatar as 'avatar', 
                        e.requiere_validar as 'require_validate',
                        e.FK_usuario as 'user_id', 
                        c.PK_id as 'career_id'
                        FROM estudiante e";


        public function getStudent_ById($id){
            $query =    $this->campos."
                        INNER JOIN carrera c ON c.PK_id = e.FK_carrera
                        WHERE e.PK_id = ".$id;
            //Obteniendo resultados
            return $this->executeQuery($query);
        }

        public function getStudent_ByUserId( $id ){
            $query = $this->campos."
                        INNER JOIN carrera c ON c.PK_id = e.FK_carrera
                        WHERE e.FK_usuario =".$id;
            //Obteniendo resultados
            return $this->executeQuery($query);
        }


        //------------------REGISTROS


        /**
         * @param $student Estudiante
         * @return array|bool|null
         */
        public function insertStuden( $student ){
            $query = "INSERT INTO estudiante(id_itson, nombre, apellido, FK_usuario, FK_carrera)
                  VALUES(
                      '".$student->getIdItson()."',
                      '".$student->getFirstName()."', 
                      '".$student->getLastname()."', 
                      ".$student->getUser()->getId().", 
                      ".$student->getCareer()->getId().")";
            return  self::executeQuery($query);
        }


    }
?>