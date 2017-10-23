<?php namespace Control;
use Carbon\Carbon;

class Funciones{

    /**
     * Método que crea un JSON String a partir de parametros
     * @param String $type Valor que identifica al objeto JSON
     * @param $result @mixed respuesta del mensaje para identificar que ocurrio (error, correcto, etc.)
     * @param String $message descripcion del mensaje
     * @param $extra null Valor Omitido por defecto, se le puede asignar cualquier valor
     * @return string regresa un JSON como String
     */
    public static function makeJsonResponse(String $type, $result, String $message, $extra = null ){
        $json = [
            'type'      => $type,
            'result'    => $result,
            'message'   => $message,
            'extra'     => $extra
        ];
        return json_encode($json);
    }

    /**
     * @param $result mixed mensaje que identifica el resultado de la peticion
     * @param String $type tipo de respuesta resultante
     * @param String $message mensaje de retorno del resultado
     * @param null $extra valor adicional que se desee agregar
     * @return array
     */
    public static function makeArrayResponse($result, String $type, String $message, $extra = null){
        $response = [
            "result" => $result,
            "type" => $type,
            "message" => $message,
            "extra" => $extra
        ];
        return $response;
    }


    /**
     * @param $hoursAndDays array Se le envia un arreglo de las horas o solamente dias y se separan
     * del arreglo formando un arreglo solo de días sin repetir
     * @return array arreglo de dias
     */
    public static function separeDays($hoursAndDays ){
        $daysArray = array();
        //Separando dias de resultado
        foreach( $hoursAndDays as $hd ){
            if( !in_array($hd['day'], $daysArray) ) {
                $daysArray[] = $hd['day'];
            }
        }
        return $daysArray;
    }

    /**
     * Método que se encarga de separar por dias las horas y dias en arrays diferentes
     * @param $hoursAndDays array de horas y dias
     * @return array null si no hay datos, array de arrays con los dias y horas
     * separados pos dias
     */
    private static function separeHoursPerDays($hoursAndDays){
        //Separa dias
        $days = self::separeDays( $hoursAndDays );
        $arrayMain = array();

        //recorrido de cada uno de los días (para comparar)
        foreach ( $days as $day ) {
            //Nuevo arreglo para dia actual
            $arrayDay = array();
            //Comparacion de dias para agregar a array
            foreach( $hoursAndDays as $hd ){
                //Si el dia actual (foreach) es igual al del arreglo
                //Se agrega a otro arreglo
                if( $hd['day'] === $day ){
                    $arrayDay[] = $hd;
                }
            }
            //Se agrega al array principal
            $arrayMain[] = $arrayDay;
        }
        return $arrayMain;
    }


    /**
     * Método que verifica si la hora del día son parte del horario del asesor
     * @param $horas array Horas array totales existentes
     * @param $hora array hora a comparar
     * @return bool TRUE si existe, FALSE si no existe
     */
    private static function isHourOfScheule($horas, $hora ){
        foreach($horas as $horaX ){
            if( $hora['id'] == $horaX['id'] )
                return true;
        }
        return false;
    }


    /**
     * @param $hoursAndDays array Arreglos de las horas y dias registradas en el sistema
     * utilizados para crear la tabla
     * @param $scheduleHoursAndDays null|array Horas y dias del horario para remarcarlas en la tabla
     * a la hora de crearse, este parametro es opcional
     */
    public static function makeScheduleTable($hoursAndDays, $scheduleHoursAndDays = null){
        $days = self::separeDays($hoursAndDays);
        $arrayHoursDays = self::separeHoursPerDays( $hoursAndDays );

        //------Encabezado
        $table = '<div class="columns-container">'."\n";

            //---Controles (no por el momento)
            //---Tabla

            for($i=0; $i<count($arrayHoursDays); $i++ ){
                //---Columna
                $table .= '<div class="column-item">'."\n";
                //---Elementos de columna
                //Se imprime día antes de elemento de hora
                $table .= '<div class="cell-item cell-header">'.$days[$i].'</div>'."\n";

                //Se obtienen los elementos del dia correspondiente (referenciado por contador de ciclo)
                foreach( $arrayHoursDays[$i] as $dh )
                    $table .= '<div class="cell-item cell-hour" data-id="'.$dh['id'].'">'.$dh['hour'].'</div>'."\n";

                //Se cierra item de columna
                $table .= '</div>'."\n";
            }

        //-------Cierre
        $table .= '</div>'."\n";


        return $table;

    }

    /**
     * Crea la tabla de busqueda
     * @param $result
     * @return string
     */
    public static function makeSearchTable($result){
        $table="";

        $table.=
            '<table class="table">
                    <tr class="bg-primary">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Abreviatura</th>
                    </tr>';

        foreach($result as $career):
            $table.='
                    <tr>
                        <td>'.$career->getId().'</td>
                        <td>'.$career->getName().'</td>
                        <td>'.$career->getShortName().'</td>
                    </tr>';
        endforeach ;

        $table.='</table>';

        return $table;
    }


    /**
     * Método que ordena las horas de cada dia por separado y los concatena para
     * @param $hoursArray
     * @param null|array $sheduleArray
     * @return string
     */
//    public static function makeScheduleTable($hoursArray, $sheduleArray = null ){
//
//        $days = self::separeDaysOfHours( $hoursArray );
//
//        //-----Encabezado (dias)
//        $head = '<table width="100%">'."\n";
//        $head .= '<tr>'."\n";
//        //Dias de la semana (columnas)
//        foreach( $days as $day ){
//            $head .= '<th><span class="dia-item">'.$day.'</span></th>'."\n";
//        }
//        $head .= '</tr>'."\n";
//
//        //-----Cuerpo (Horas)
//        $body = null;
//        $cont = 0;
//        foreach($hoursArray as $hour ){
//
//            if( $cont == 0 ) {
//                $body .= "<tr>\n";
//            }
//            else if( $cont == count($days) ) {
//                $body .= "</tr>\n";
//                $cont = 0;
//            }
//            //Siempre se ejecuta
//            if( $cont < count($days) ) {
//                $cont++;
//
//                //---------------COLUMNAS
//                //Si se le envia un horario, es para que marque aquellas ya seleccionadas
//                $body .= '<td>';
//                if( $sheduleArray != null ){
//                    if( self::isHourOfScheule($sheduleArray, $hour) )
//                        $body .= '<span class="hora-item hora-selected" data-id="'.$hour['id'].'" data-day="'.$hour['day'].'" data-hour="'.$hour['hour'].'">'.$hour['hour'].'</span>';
//                    else
//                        $body .= '<span class="hora-item" data-id="'.$hour['id'].'" data-day="'.$hour['hour'].'" data-hour="'.$hour['hour'].'">'.$hour['hour'].'</span>';
//                }
//                else
//                    $body .= '<span class="hora-item" data-id="'.$hour['id'].'" data-day="'.$hour['day'].'" data-hour="'.$hour['hour'].'">'.$hour['hour'].'</span>';
//                $body .= "</td>\n";
//
//            }
//        }
//
//        $body .= "</table>\n";
//        return $head.$body;
//    }


//    public static function getCurrentDate(){}




}


?>