<?php namespace Modelo\Persistencia;

 use Control\Funciones;
 use Objetos\Usuario;

 /**
 * Class Usuarios
 * @package Modelo\Persistencia
 */
class Usuarios extends Persistencia{

    public function __construct(){}

    private $SELECT = "SELECT u.PK_id as 'user_id',
                        u.nombre_usuario as 'username',
                        u.correo as 'email',
                        u.fecha_registro as 'date',
                        u.fecha_registro as 'status',
                        r.nombre as 'role'
                    FROM usuario u
                    INNER JOIN rol r ON r.PK_id = u.FK_rol";

    /**
     * Método que regresa todos los usuarios
     */
    public function getUsers(){
        $query = $this->SELECT;
        return  self::executeQuery($query);
    }


    /**
     * Método que regresa un usuario en la coincidencia con un nombre de
     * usuario y la contraseña
     * @param String $user Nombre de usuario
     * @param String $pass Contraseña
     */
    public function getUser_ByAuth($user, $pass){
        $ePass = $this->encrypt($pass);
        $query = $this->SELECT."
                WHERE (u.nombre_usuario = '".$user."' OR u.correo = '".$user."') 
                AND u.password = '".$ePass."' ";
        return  self::executeQuery($query);
    }

    /**
     * Método que regresa un usuario en la coincidencia con el ID
     * @param int $id ID del usuario
     */
    public function getUser_ById($id){
        $query = $this->SELECT."
                WHERE u.PK_id = ".$id;
        return  self::executeQuery($query);
    }

    /**
     * @return array|bool|null
     */
    public function getUser_Last(){
        $query = $this->SELECT." 
                  ORDER BY PK_id DESC LIMIT 1";
        return  self::executeQuery($query);
    }

    /**
     * @param $username String
     */
    public function getUser_ByUsername($username){
        $query = $this->SELECT." 
                 WHERE u.nombre_usuario = '".$username."'";
        return self::executeQuery($query);
    }

    /**
     * @param $email String
     * @return array|bool|null
     */
    public function getUser_ByEmail($email){
        $query = $this->SELECT." 
                 WHERE u.correo = '".$email."'";
        return  self::executeQuery($query);
    }

    //------------------ INSERTS

    /**
     * @param $user Usuario
     * @return array|bool|null
     */
    public function insertUser( $user ){
        $passC = self::encrypt( $user->getPassword() );
        $query = "INSERT INTO usuario(nombre_usuario, password, correo, FK_rol)
                  VALUES('".$user->getUsername()."','".$passC."','".$user->getEmail()."', 2)";
        return  self::executeQuery($query);
    }




}