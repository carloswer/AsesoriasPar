<?php namespace Modelo\Persistencia;

use Objetos\Carrera;

class Carreras extends Persistencia {
    public function __construct(){}


    //TODO: agregar estado
    private $campos = "SELECT
                            PK_id as 'id',
                            nombre as 'name',
                            abreviacion as 'short_name',
                            fecha_registro as 'date'
                            FROM carrera";

    /**
     * @return array|bool|null
     */
    public function getCareers(){
        $query = $this->campos;
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCareer_ById( $id ){
        $query = $this->campos."
                        WHERE PK_id =".$id;
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    /**
     * @param $name
     * @return array|bool|null
     */
    public function getCareer_ByName( $name ){
        $query = $this->campos."
                     WHERE nombre LIKE '%".$name."%'";
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    /**
     * @param $name
     * @return array|bool|null
     */
    public function getCareer_ByShort_name( $short_name ){
        $query = $this->campos."
                     WHERE abreviacion = '".$short_name."' ";
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    /**
     * @param $career
     * @return array|bool|null
     */
    public function insertCareer( $career ){
        $query = "INSERT INTO carrera (nombre, abreviacion)
                  VALUES('".$career->getName()."','".$career->getShortName()."')";
        return  self::executeQuery($query);
    }


    /**
     * @param $career
     * @return array|bool|null
     */
    public function updateCareer( $career ){
        $query = "UPDATE carrera 
                      SET nombre = '".$career->getName()."', abreviacion = '".$career->getShortName()."' 
                      WHERE PK_id = ".$career->getId();
        return  self::executeQuery($query);
    }

    /**
     * @param $career
     * @return array|bool|null
     */
    public function deleteCareer( $career ){
        $query = "DELETE FROM carrera 
                      WHERE PK_id = ".$career->getId();
        return  self::executeQuery($query);
    }

}

?>