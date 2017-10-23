<?php namespace Modelo\Database;

    use Exception;
use mysqli;

    class MySQLConexion {


        private $datos = [
            'host' => "localhost",
            'user' => 'asesoriaspar_itson',
            'pass' => 'asesorias_pass',
            'db'   => 'asesoriaspar'
        ];
        private $_connection;

        /**
         * Constructor que instancia una nueva conexión a la base de persistencia
         */
        public function __construct() {

            //Datos de conexion
            $this->_connection = new mysqli(
                $this->datos['host'],
                $this->datos['user'],
                $this->datos['pass'],
                $this->datos['db']
            );

            //TODO: Modificar para poder regresar error y mostrar en vista
             //Manejo de error
            if( mysqli_connect_error() ) {
                trigger_error("Error al tratar de conectar con MySQL: " . mysqli_connect_error(),
                    E_USER_ERROR);
            }

            /* cambiar el conjunto de caracteres a utf8 para aceptar tildes y 'eñes' */
            if ( !$this->_connection->set_charset('utf8') ) {
                printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->_connection->error);
            }
        }


        /**
         * @param $query String a ejecutar
         * @return bool|\mysqli_result Regresa un mysqli_result en caso de ser una consulta exitosa
         * de un SELECT, TRUE cuando es diferente de un SELECT exitoso y FALSE al ocurrir un error.
         */
        public function doQuery($query){
            return $this->_connection->query($query);
        }

        /**
         * Regresa el ultimo error ocurrido
         * @return string Mensaje del error
         */
        public function getError(){
            return $this->_connection->error;
        }

        /**
         * Cierra la conexión
         * @return bool FALSE en caso de error o fallo, TRUE exitoso
         */
        public function closeConnection(){
            return $this->_connection->close();
        }


        //----------TRANSACCIONES
        /**
         * Inicio de transaccion (evita el registro automatico de datos)
         * @return bool FALSE en caso de error o fallo, TRUE exitoso
         */
        public function iniTransaction(){
            return $this->_connection->autocommit( false );
        }

        /**
         * Commit de transaccion (Registro de datos)
         * @return bool FALSE en caso de error o fallo, TRUE exitoso
         */
        public function doCommit(){
            return $this->_connection->commit();
        }

        /**
         * Retroceso en registro de datos (no registra)
         * @return bool FALSE en caso de error o fallo, TRUE exitoso
         */
        public function doRollback(){
           return $this->_connection->rollback();
        }





    }

?>
