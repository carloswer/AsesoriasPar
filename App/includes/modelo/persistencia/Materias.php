<?php namespace Modelo\Persistencia;

use Objetos\Materia;

class Materias extends Persistencia{
    public function __construct(){}

    private $campos = "SELECT
                            m.PK_id as 'id',
                            m.nombre as 'name',
                            m.abreviacion as 'short_name',
                            m.descripcion as 'description',
                            m.semestre as 'semester',
                            m.plan as 'plan',
                            m.FK_carrera
                            FROM materia m ";

    /**
     * @return array|bool|null
     */
    public function getSubjects(){
        $query = $this->campos;
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    /**
     * @param $subject_id
     * @return array|bool|null
     */
    public function getSubjects_ById($subject_id){
        $query = $this->campos."
                     WHERE m.PK_id = ".$subject_id;
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    public function getSubjects_ByScheduleId( $id ){
        $query = $this->campos." 
                        INNER JOIN horario_materia hm ON hm.FK_materia = m.PK_id
                        INNER JOIN horario h ON h.PK_id = hm.FK_horario
                        INNER JOIN carrera c ON m.FK_carrera = c.PK_id
                        WHERE hm.FK_horario = ".$id."
                        ORDER BY m.semestre, m.nombre ASC";
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    public function getSubjecs_ByCareerId( $careerId ){
        $query = $this->campos." 
                        INNER JOIN carrera c ON m.FK_carrera = c.PK_id 
                        WHERE c.PK_id = ".$careerId." 
                        ORDER BY m.semestre, m.nombre ASC";
        //Obteniendo resultados
        return self::executeQuery($query);
    }


    public function getSubjecs_ByCareerName( $careerName ){
        $query = $this->campos."
                        INNER JOIN carrera c ON m.FK_carrera = c.PK_id 
                        WHERE (c.nombre = '".$careerName."' OR c.abreviacion = '".$careerName."') 
                        ORDER BY m.semestre, m.nombre ASC";
        //Obteniendo resultados
        return self::executeQuery($query);
    }


    //-----------------
    // DE HORARIOS
    //-----------------

    /**
     * @param $idStudent
     */
    public function getAvailScheduleSubs_SkipSutdent( $idStudent, $idCycle ){
        //Para que no se repita
        $select = str_replace("SELECT", "SELECT DISTINCT", $this->campos);

        $query = $select."
                    INNER JOIN carrera c ON m.FK_carrera = c.PK_id 
                    INNER JOIN horario_materia hm ON hm.FK_materia = m.PK_id
                    INNER JOIN horario h ON h.PK_id = hm.FK_horario
                    WHERE (h.FK_ciclo = ".$idCycle.") AND (h.FK_estudiante <> ".$idStudent.")
                    ORDER BY m.semestre, m.nombre ASC";
        return self::executeQuery($query);
    }

    /**
     * @param $name
     * @return array|bool|null
     */
    public function getSubject_ByName( $subject )
    {
        $query = $this->campos."
                     WHERE m.nombre = '".$subject->getName()."' AND m.FK_carrera = ".$subject->getCareer()." AND m.plan = ".$subject->getSchoolPlan()." ";
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    /**
     * @param $short_name
     * @return array|bool|null
     */
    public function getSubject_ByShort_name( $subject )
    {
        $query = $this->campos."
                     WHERE m.abreviacion = '".$subject->getShortName()."' AND m.FK_carrera = ".$subject->getCareer()." AND m.plan = ".$subject->getSchoolPlan()." ";
        //Obteniendo resultados
        return self::executeQuery($query);
    }


    /**
     * @param $career
     * @return array|bool|null
     */
    public function getSubject_ByCareer( $career )
    {
        $query = $this->campos."
                     WHERE m.FK_carrera = ".$career." ";
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    /**
     * @param $plan
     * @return array|bool|null
     */
    public function getSubject_ByPlan( $plan )
    {
        $query = $this->campos."
                     WHERE m.plan = '".$plan."'";
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    /**
     * @param $subject
     * @return array|bool|null
     */
    public function getSubject_BySemester( $semester )
    {
        $query = $this->campos."
                     WHERE m.semestre = ".$semester." ";
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    /**
     * @param $name
     * @return array|bool|null
     */
    public function getSubject_ByNameOnSearch( $name )
    {
        $query = $this->campos."
                     WHERE m.nombre LIKE '%".$name."%'";
        //Obteniendo resultados
        return self::executeQuery($query);
    }

    /**
     * @param $name
     * @return array|bool|null
     */
    public function getSubject_ByShortNameOnSearch( $short_name )
    {
        $query = $this->campos."
                     WHERE m.abreviacion = '".$short_name ."'";
        //Obteniendo resultados
        return self::executeQuery($query);
    }


    /**
     * @param $subject
     * @return array|bool|null
     */
    public function insertSubject($subject)
    {
        $query = "INSERT INTO materia (nombre, abreviacion, descripcion, semestre, plan, FK_carrera) 
                      VALUES ('".$subject->getName()."','".$subject->getShortName()."','".$subject->getDescription()."',".$subject->getSemester().",'".$subject->getSchoolPlan()."',".$subject->getCareer().")";
        return  self::executeQuery($query);
    }

    /**
     * @param $subject
     * @return array|bool|null
     */
    public function updateSubject($subject)
    {
        $query = "UPDATE materia m 
                      SET m.nombre = '".$subject->getName()."', m.abreviacion = '".$subject->getShortName()."', m.descripcion = '".$subject->getDescription()."', m.semestre = ".$subject->getSemester().", m.plan = '".$subject->getSchoolPlan()."', m.FK_carrera = ".$subject->getCareer()."  
                      WHERE m.PK_id = ".$subject->getId();
        return  self::executeQuery($query);
    }

    public function deleteSubject( $subject ){
        $query = "DELETE FROM materia 
                      WHERE PK_id = ".$subject->getId();
        return  self::executeQuery($query);
    }



}

?>