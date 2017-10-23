<?php namespace Modelo\Persistencia;


class Asesorias extends Persistencia{

    public function __construct(){}

    private $selectComun = "SELECT 
                    a.PK_id as 'id',
                    a.fecha as 'date',
                    a.fecha_solicitud as 'register_date',
                    a.hora as 'hour',
                    a.descripcion as 'descriptin',
                    
                    ea.PK_id as 'status_id',
                    ea.tipo as 'status_type',
                    ea.comentario as 'status_comment',
                    ea.fecha_validacon as 'status_date',
                    ea.calificacion_asesor as 'status_calification'
                    
                    m.PK_id as 'subject_id',
                    e_al.PK_id as 'alumno_id',
                    e_as.PK_id as 'asesor_id'
                    
                    FROM asesoria a
                    INNER JOIN estudiante e_al ON e_al.PK_id = a.FK_alumno
                    INNER JOIN estudiante e_as ON e_as.PK_id = a.FK_asesor
                    INNER JOIN horario_materia hm ON hm.PK_id = a.FK_materia
                    INNER JOIN materia m ON m.PK_id = hm.FK_materia
                    INNER JOIN horario h ON h.PK_id = hm.FK_horario
                    LEFT JOIN estado_asesoria ea ON ea.FK_asesoria = a.PK_id";


    public function getAsesoriasLikeAsesor_ByStudentIdAndSchedule($isStudent, $idCycle ){
        $query = $this->selectComun."
                    WHERE a.FK_asesor = ".$isStudent." AND h.FK_ciclo = ".$idCycle;
        return self::executeQuery($query);
    }


    public function getAsesoriasLikeAlumno_ByStudentIdAndCycle( $idStudent, $idCycle ){
        $query = $this->selectComun."
                    WHERE a.FK_alumno = ".$idStudent." AND h.FK_ciclo = ".$idCycle;
        return self::executeQuery($query);
    }



}