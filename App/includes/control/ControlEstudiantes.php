<?php namespace Control;

use Modelo\Persistencia\Estudiantes;
use Objetos\Estudiante;

class ControlEstudiantes{

    private $perStudents;

    public function __construct(){
        $this->perStudents = new Estudiantes();
    }

    public function getStudent_ById( $id ){
        $result = $this->perStudents->getStudent_ById( $id );
        if( $result == false )
            return 'error';
        else if( $result == null )
            return null;
        else{
            // Crea objeto
            return self::makeObject_Student( $result[0] );
        }
    }

    public function isStudentExist_ById($id){
        $result = $this->perStudents->getStudent_ById( $id );
        if( $result === false )
            return 'error';
        else if( $result === null )
            return false;
        else
            return true;
    }


    public function getStuden_ByUserId( $id ){
        $result = $this->perStudents->getStudent_ByUserId( $id );
        if( $result == false )
            return 'error';
        else if( $result == null )
            return null;
        else{
            // Crea objeto
            return self::makeObject_Student( $result[0] );
        }
    }





    //----------REGISTRAR ESTUDIANTE

    /**
     * @param $student Estudiante
     * @return null|Estudiante|string
     */
    public function insertStudent( $student ){
        $result = $this->perStudents->insertStuden( $student );
        if( $result == false )
            return 'error';
        else
            return true;
    }





    /**
     * @param $s array
     * @return Estudiante
     */
    public static function makeObject_Student($s){
        // Crea objeto
        $student = new Estudiante();
        // Asigna datos
        //TODO: agregar usuario completo
        $conUsers = new ControlUsuarios();
        $user = $conUsers->getUser_ById( $s['user_id'] );
        $student->setUser( $user );
        $student->setIdStudent( $s['id_student'] );
        $student->setIdItson( $s['id_itson'] );
        $student->setFirstName( $s['first_name'] );
        $student->setLastname( $s['last_name'] );
        $student->setPhone( $s['phone'] );
        $student->setFacebook( $s['facebook'] );
        $student->setAvatar( $s['avatar'] );

        $conCareers = new ControlCarreras();
        $career = $conCareers->getCareer_ById( $s['career_id'] );
        $student->setCareer( $career );

        //Se regresa
        return $student;
    }




}