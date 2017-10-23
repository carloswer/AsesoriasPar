<?php namespace Modelo\Persistencia;


use Objetos\Ciclo;

class Ciclos extends Persistencia{


    public function __construct(){}

    //TODO: cambiar a ingles
    private $campos = "SELECT
                          PK_id as 'id',
                          fecha_inicio as 'start',
	                      fecha_fin as 'end',
	                      fecha_registro as 'date'
                        FROM ciclo ";

    public function getCycles(){
        $query = $this->campos;
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    public function getCycles_ByDate($start, $end){
        $query = $this->campos."
                     WHERE fecha_inicio = '".$start."' AND fecha_fin = '".$end."' ";
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    public function getCycles_ById($id){
        $query = $this->campos."
                     WHERE PK_id = ".$id;
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    public function getCycle_ByScheduleId( $id ){
        $query = $this->campos." 
                        INNER JOIN horario h ON h.FK_ciclo = c.PK_id
                        WHERE h.PK_id = ".$id."";
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    public function getCycle_betweenDates($date,$start,$end){
        $query = $this->campos."
                        WHERE ('".$date."' BETWEEN '".$start."' AND '".$end."')";
        return self::executeQuery($query);
    }
    /**
     * @param $cycle Ciclo
     * @return array|bool|null
     */
    public function insertCycle( $cycle ){
        $query = "INSERT INTO ciclo (fecha_inicio, fecha_fin) 
                  VALUES('".$cycle->getStart()."','".$cycle->getEnd()."')";
        return  self::executeQuery($query);
    }

    /**
     * @param $cycle Ciclo
     * @return array|bool|null
     */
    public function updateCycle( $cycle ){
        $query = "UPDATE ciclo c
                  SET c.fecha_inicio =  '".$cycle->getStart()."' , c.fecha_fin = '".$cycle->getEnd()."'
                  WHERE c.PK_id = ".$cycle->getId();
        return  self::executeQuery($query);
    }

    /**
     * @param $id Ciclo
     * @return array|bool|null
     */
    public function deleteCycle( $id ){
        $query = " DELETE FROM ciclo
                   WHERE PK_id = " .$id;

        
        return  self::executeQuery($query);
    }
}

?>