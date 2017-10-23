<?php namespace Modelo\Persistencia;

    class Horarios extends Persistencia{

        public function __construct(){}


        //------------
        // HORAS / DIAS / PERIODO
        //------------

        public function getDays(){
            $query = "SELECT DISTINCT dia FROM dia_hora";
            //Obteniendo resultados
            return self::executeQuery($query);
        }

        public function getHoursAndDays(){
            $query = "SELECT 
                        PK_id as 'id',
                        dia as 'day',
                        TIME_FORMAT(hora, '%H:%i') as 'hour' 
                        FROM dia_hora
                      ORDER BY dia_numero, hora";
            //Obteniendo resultados
            return self::executeQuery($query);
        }

        public function getHoursAndDays_OrderByHours(){
            $query = "SELECT 
                        PK_id as 'id',
                        dia as 'day',
                        TIME_FORMAT(hora, '%H:%i') as 'hour' 
                        FROM dia_hora
                      ORDER BY PK_id";
            //Obteniendo resultados
            return self::executeQuery($query);
        }


        public function getCurrentCycle(){
            $query = "SELECT 
                        PK_id as 'id',
                        fecha_inicio as 'start', 
                        fecha_fin as 'end'
                      FROM  ciclo
                      WHERE DATE(NOW()) BETWEEN fecha_inicio AND fecha_fin";
            //Obteniendo resultados
            return self::executeQuery($query);
        }


        //------------
        // HORARIO DE ASESOR
        //------------

        public function getScheduleMain_ByStudentId($idStudent, $idCycle){
            $query = "SELECT 
                        PK_id as 'id',
                        fecha_registro as 'register_date',
                        validado as 'validated',
                        estado as 'status'
                      FROM horario h
                      WHERE h.FK_ciclo = ".$idCycle." AND h.FK_estudiante = ".$idStudent."
                      ORDER BY h.PK_id DESC LIMIT 1";
            //Obteniendo resultados
            return self::executeQuery($query);
        }

        public function getScheduleHours_ByScheduleId(int $scheduleid ){
            $query = "SELECT 
                            dh.PK_id as 'id',
                            dh.hora as 'hour',
                            dh.dia as 'day'
                        FROM horario_dia_hora hdh
                        INNER JOIN dia_hora dh ON dh.PK_id = hdh.FK_dia_hora
                        WHERE hdh.FK_horario = ".$scheduleid."
                        ORDER BY dh.PK_id";
            //Obteniendo resultados
            return self::executeQuery($query);
        }


        public function insertSchedule($idStudent, $idCycle ){
            $query = "INSERT INTO horario(FK_estudiante, FK_ciclo)
                      VALUES (".$idStudent.", ".$idCycle.")";
            //Obteniendo resultados
            return self::executeQuery($query);
        }

        public function insertScheduleHours($idSchedule, $hours){
            foreach( $hours as $hour ){
                $query = "INSERT INTO horario_dia_hora(FK_horario, FK_dia_hora) VALUES
                      (".$idSchedule.", ".$hour.")";
                $result = self::executeQuery($query);
                //Si ocurrio un error, Pelos!
                if( !$result )
                    return false;
            }
            //Si salio bien
            return true;
        }

        public function insertScheduleSubjects( $idSchedule ,$subjects){
            foreach( $subjects as $sub ){
                $query = "INSERT INTO horario_materia(FK_horario, FK_materia) VALUES
                        (".$idSchedule.", ".$sub.");";
                $result = self::executeQuery($query);
                //Si ocurrio un error, Pelos!
                if( !$result )
                    return false;
            }
            //Si salio bien
            return true;
        }


        /**
         * Obtiene los horarios (sin repetir) de los asesores que dan asesorias de una materia
         * en especifico
         * @param $subjectId string id de materia a buscar
         * @param $studentId string estudiante a omitir
         * @param $cycleId string ciclo del horario en el que se buscará
         * @return array|bool|null
         */
        public function getAvailSchedules_SkipStudent_ByCycle($subjectId, $studentId, $cycleId){
            $query = "SELECT DISTINCT
                        dh.PK_id as 'id',
                        dh.hora as 'hora',
                        dh.dia as 'dia'
                    FROM horario_materia hm
                    INNER JOIN horario h ON h.PK_id = hm.FK_horario
                    INNER JOIN horario_dia_hora hdh ON hdh.FK_horario = h.PK_id
                    INNER JOIN dia_hora dh ON dh.PK_id = hdh.FK_dia_hora
                    INNER JOIN estudiante e ON e.PK_id = h.FK_estudiante
                    INNER JOIN materia m ON m.PK_id = hm.FK_materia
                    WHERE (h.FK_ciclo = ".$cycleId.") AND (e.PK_id <> ".$studentId.") AND (m.PK_id = ".$subjectId.")
                    ORDER BY dh.hora, dh.PK_id";
            //Obteniendo resultados
            return self::executeQuery($query);
        }

        /*
        public function getAvailSchedules($subjectId, $studentId, $cycleId){
            $query = "SELECT DISTINCT
                        dh.PK_id as 'id',
                        dh.hora as 'hora',
                        dh.dia as 'dia'
                    FROM horario_materia hm
                    INNER JOIN horario h ON h.PK_id = hm.FK_horario
                    INNER JOIN horario_dia_hora hdh ON hdh.FK_horario = h.PK_id
                    INNER JOIN dia_hora dh ON dh.PK_id = hdh.FK_dia_hora
                    INNER JOIN estudiante e ON e.PK_id = h.FK_estudiante
                    INNER JOIN materia m ON m.PK_id = hm.FK_materia
                    ORDER BY dh.hora, dh.PK_id";
            //Obteniendo resultados
            return self::executeQuery($query);
        }
        */




    }
?>