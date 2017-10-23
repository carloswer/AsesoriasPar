<?php namespace Control;

use Modelo\Persistencia\Usuarios;
use Objetos\Estudiante;
use Objetos\Usuario;

class ControlUsuarios{

    private $perUsers;

    public function __construct(){
        $this->perUsers = new Usuarios();
    }


    public function getUser_ByAuth($user, $pass){
        $result = $this->perUsers->getUser_ByAuth($user, $pass);
        if( $result === false ){
            return 'error';
        }
        else if( $result === null )
            return null;
        else
            return self::makeObject_User($result[0]);
    }

    public function getUser_ById($id){
        
        
        $result = $this->perUsers->getUser_ById( $id );
        if( $result === false )
            return 'error';
        else if( $result === null )
            return null;
        else
            return self::makeObject_User($result[0]);
    }

    /**
     * @param $id
     * @return bool|null|Usuario|string
     */
    public function isUserExist_ById($id){
        $result = $this->getUser_ById($id);
        if( $result === 'error' )
            return $result;
        else if( $result === null )
            return false;
        else
            return true;
    }

    /**
     * @param $username String
     * @return null|Usuario|string
     */
    public function getUser_ByUsername( $username ){
        

        $result = $this->perUsers->getUser_ByUsername( $username );
        if( $result === false )
            return 'error';
        else if( $result === null )
            return null;
        else
            return self::makeObject_User($result[0]);
    }

    /**
     * @param $username String
     * @return bool|null|Usuario|string
     */
    public function isUserExist_ByUsername($username){
        $result = $this->getUser_ByUsername($username);
        if( $result === 'error' )
            return $result;
        else if( $result === null )
            return false;
        else
            return true;
    }


    public function getUser_ByEmail($email){
        

        $result = $this->perUsers->getUser_ByEmail( $email );
        if( $result === false )
            return 'error';
        else if( $result === null )
            return null;
        else
            return self::makeObject_User($result[0]);
    }


    /**
     * @param $email String
     */
    public function isUserExist_ByEmail($email){
        $result = $this->getUser_ByEmail($email);
        if( $result === 'error' )
            return $result;
        else if( $result === null )
            return false;
        else
            return true;
    }



    //------------------REGISTRAR USUARIO

    /**
     * @param $user Usuario
     * @param $student Estudiante
     * @return array
     */
    public function insertUserAndStudent($user, $student){
        $trans = Usuarios::initTransaction();
        //TODO: cambiar los "response" por el metodo @see Funciones::makeArrayResponse
        if( !$trans ){
            $response = [
                "result" => 'error',
                "type" => "username",
                "message" => "No se pudo iniciar transaccion"
            ];
            return $response;
        }


        //------------Verificacion de datos
        //Verificamos si el nombre de usuario ya existe
        $result = $this->isUserExist_ByUsername( $user->getUsername() );

        if( $result === 'error' ){
            Usuarios::rollbackTransaction();
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener usuario por nombre de usuario"
            ];
            return $response;
        }
        else if( $result === true ) {
            Usuarios::rollbackTransaction();
            $response = [
                "result" => false,
                "type" => "username",
                "message" => "Nombre de usuario ya existe",
            ];
            return $response;
        }

        //Verificamos que correo no exista
        $result = $this->isUserExist_ByEmail( $user->getEmail() );
        if( $result === 'error' ){
            Usuarios::rollbackTransaction();
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener email"
            ];
            return $response;
        }
        else if( $result === true ) {
            Usuarios::rollbackTransaction();
            $response = [
                "result" => false,
                "type" => 'email',
                "message" => "Email ya existe"
            ];
            return $response;
        }


        //Se verifica carrera
        $conCareer = new ControlCarreras();

        $result = $conCareer->getCareer_ById( $student->getCareer() );
        if( $result === 'error' ){
            Usuarios::rollbackTransaction();
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener carrera por id"
            ];
            return $response;
        }
        else if( $result === null ) {
            Usuarios::rollbackTransaction();
            $response = [
                "result" => false,
                "type" => 'career',
                "message" => "Carrera no existe"
            ];
            return $response;
        }

        //Se asigna carrera a estudiante
        $student->setCareer( $result );


        //------------Iniciamos registro
        
        //Registramos usuario
        $result = $this->perUsers->insertUser( $user );
        if( $result === false ){
            Usuarios::rollbackTransaction();
            $response = [
                "result" => 'error',
                "message" => "No se pudo registrar usuario"
            ];
            return $response;
        }


        //Registramos ultimo usuario (debe ser el mismo)
        //TODO: obtener con el nombre de usuario para evitar problemas
        $result = $this->perUsers->getUser_ByUsername( $user->getUsername() );
        if( $result === false ){
            Usuarios::rollbackTransaction();
            $response = [
                "result" => 'error',
                "message" => "No se pudo obtener usuario registrado anteriormente"
            ];
            return $response;
        }
        else if( $result === null ) {
            Usuarios::rollbackTransaction();
            $response = [
                "result" => false,
                "message" => "Usuario no existe"
            ];
            return $response;
        }

        //Obtiene Id del usuario y se lo agrega al estudiante
        $userObj = self::makeObject_User( $result[0] );


        //Registramos estudiante
        $student->setUser( $userObj );
        $conStudents = new ControlEstudiantes();

        $result = $conStudents->insertStudent( $student );
        if( $result === false ){
            Usuarios::rollbackTransaction();
            $response = [
                "result" => 'error',
                "message" => "No se pudo registrar estudiante"
            ];
            return $response;
        }

        $trans = $this->perUsers::commitTransaction();
        if( !$trans ){
            $response = [
                "result" => 'error',
                "message" => "No se pudo hacer commit"
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



    //-----------------------
    // EXTRAS
    //-----------------------
    /**
     * array['field']
     *
     * @param $data array
     * @return Usuario
     */
    public static function makeObject_User( $data ){
        $user = new Usuario();
        //setting data
        $user->setId( $data['user_id'] );
        $user->setUsername( $data['username'] );
        $user->setEmail( $data['email'] );
        $user->setRegisterDate( $data['date'] );
        $user->setStatus( $data['status'] );
        $user->setRole( $data['role'] );
        //Returning object
        return $user;
    }




}