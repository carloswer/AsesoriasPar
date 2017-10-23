<?php namespace Control;

use Modelo\Persistencia\Ciclos;
use Objetos\Ciclo;

class ControlCiclos{

    private $perCycles;

    public function __construct(){
        $this->perCycles = new Ciclos();
    }

    /**
     * @param $cycle_id
     */
    public function getCycle_ById( $cycle_id ){
        $result = $this->perCycles->getCycles_ById( $cycle_id );
        if( $result === false )
            return 'error';
        else if( $result === null )
            return null;
        else
            return $arrayCycles[] = $this->makeObject_cycle($result[0]);
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function isCycleExist_ById($id){
        $result = $this->perCycles->getCycles_ById( $id );
        if( $result === false )
            return 'error';
        else if( $result === null )
            return false;
        else
            return true;
    }


    /**
     * @param $cyc array
     * @return Ciclo
     */
    private function makeObject_cycle($cyc){

        // Crea objeto
        $cycle = new Ciclo();
        $cycle->setId($cyc['id']);
        $cycle->setStart($cyc['start']);
        $cycle->setEnd($cyc['end']);
        $cycle->setDate($cyc['date']);
        return $cycle;

        // Cycle es NULL
    }

    /**
     * @return array|null|string
     */
    public function getCycles(){

        $result = $this->perCycles->getCycles();
        if( $result === false )
            return 'error';
        else if( $result == null )
            return null;
        else{
            $array = array();
            foreach( $result as $cyc ){
                $array[] = self::makeObject_cycle($cyc);
            }
            return $array;
        }
    }

    /**
     * @param $cycle Ciclo
     * @return null|string
     */
    public function getCycle_ByDate( $cycle ){

        $start = $cycle->getStart();
        $end = $cycle->getEnd();

        $result = $this->perCycles->getCycles_ByDate( $start, $end);
        if( $result === false )
            return 'error';
        else if( $result === null )
            return null;
        else
            return self::makeObject_cycle($result[0]);

    }

    /**
     * @return array|null|string
     */
    public function getCyclesBetween($date){
        $valor = true;
        $result = $this->perCycles->getCycles();
        if( $result === false )
            return 'error';
        else if( $result == null )
            return null;
        else{
            $arrayCycles = array();

            foreach( $result as $cyc ){
                //Se agrega al array
                $arrayCycles[] = $this->makeObject_cycle($cyc);

                $start = $arrayCycles[0]->getStart();
                $end = $arrayCycles[0]->getEnd();
                //Verificamos si esta entre otras fechas
                $result = $this->perCycles->getCycle_betweenDates($date,$start,$end);
                if($result === 'error'){
                    return 'error';
                }else if($result === null){
                    $valor = false;
                }else{
                    return true;
                }
            }
            if($valor === false ){
                return false;
            }else{
                return true;
            }
        }
    }




    /**
     * @param $cycle Ciclo
     * @return array|bool|null
     */
    public function isCycleExist_ByDate( $cycle ){

        $result = $this->getCycle_ByDate($cycle);
        if( $result === 'error' )
            return $result;
        else if( $result === null )
            return false;
        else
            return true;

    }

    /**
     * @param $schedule
     * @return array|bool|null
     */
    public function getCycle_ByScheduleId( $schedule ){
        $result = $this->perCycles->getCycle_ByScheduleId( $schedule );
        if( $result === false )
            return 'error';
        else if( $result === null )
            return null;
        else{
            $arrayCycles = array();
            foreach( $result as $cyc ) {
                //Se agrega al array
                $arrayCycles[] = $this->makeObject_cycle($cyc);
            }
            return $arrayCycles;
        }
    }

    /**
     * @param $cycle
     * @return array
     */
    public function insertCycles( $cycle ){

        //Verificamos que el ciclo no exista

        //REGRESA TRUE O FALSE
        $result = $this->isCycleExist_ByDate($cycle);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener ciclo por fecha"
            ];
            return $response;
        }

        else if( $result === true ) {
            $response = [
                "result" => false,
                "type" => "cycle",
                "message" => "Ciclo ya existe",
            ];
            return $response;
        }

        // VALIDACION DE FECHAS

        $start = $cycle->getStart();
        // REGRESA TRUE O FALSE
        $result = $this->getCyclesBetween($start);

        if($result === 'error'){
            $response = [
                "result" => 'error',
                "message" => "Error al registrar el ciclo"
            ];
            return $response;
        }

        if($result === true){
            $response = [
                "result" => 'error',
                "message" => "El ciclo se empalma"
            ];
            return $response;
        }

//        Inicia registro de Ciclo
        $result = $this->perCycles->insertCycle( $cycle );

        if( $result === false ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo registrar el ciclo"
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

//   ------------------------------------- UPDATE CYCLES

    /**
     * @param $cycle
     * @return array
     */
    public function updateCycles( $cycle ){

        //Verificamos con el id ingresado si el ciclo existe para poder modificarlo

        $id = $cycle->getId();
        $result = $this->isCycleExist_ById($id);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener ciclo por fecha"
            ];
            return $response;
        }
        else if( $result === false ) {
            $response = [
                "result" => false,
                "type" => "cycle",
                "message" => "Ciclo no existe"
            ];
            return $response;
        }

        // Si existe el ciclo a modificar, verificamos si las fechas ya las tiene otro ciclo
        $result = $this->isCycleExist_ByDate($cycle);

        if($result === 'error'){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener ciclo por fecha"
            ];
            return $response;
        }

        if($result === false){

            $result = $this->perCycles->updateCycle( $cycle );

            if( $result === false ){
                $response = [
                    "result" => 'error',
                    "message" => "No se pudo actualizar el ciclo"
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

        //Si el nuevo ciclo ya existe
        $response = [
            "result" => false,
            "message" => "El ciclo ya existe"
        ];
        return $response;




    }

    //   ------------------------------------- DELETE CYCLES

    /**
     * @param $cycle
     * @return array
     */
    public function deleteCycles( $cycle ){

        //Verificamos que el ciclo no exista
        $id = $cycle->getId();
        $result = $this->isCycleExist_ById($id);
        if( $result === 'error' ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener ciclo por id"
            ];
            return $response;
        }
        else if( $result === false ) {
            $response = [
                "result" => false,
                "type" => "cycle",
                "message" => "Ciclo no existe"
            ];
            return $response;
        }

        $result = $this->perCycles->deleteCycle( $id );

        if( $result === false ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo eliminar el ciclo"
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



}
?>


