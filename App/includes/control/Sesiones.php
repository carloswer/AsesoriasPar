<?php namespace Control;

    use Objetos\Carrera;
    use Objetos\Usuario;
    use Objetos\Estudiante;
    use Control\ControlEstudiantes;
    use Control\ControlUsuarios;
    session_start();


    class Sesiones{

        public static $ALUMNO = 'alumno';
        public static $ASESOR = 'asesor';

		//---------------- LOGGIN

		public static function setUserSession(Usuario $user){
            //Datos del usuario
			$_SESSION['user']['id']       = $user->getId();
            $_SESSION['user']['username'] = $user->getUsername();
            $_SESSION['user']['role']     = $user->getRole();
		}

        public static function setStudentSession(Estudiante $student){
            //Datos del usuario
            $_SESSION['student']['id']      = $student->getIdStudent();
            $_SESSION['student']['name']    = $student->getFirstName() . " " . $student->getLastname();
            $_SESSION['student']['career']  = $student->getCareer();
        }


        public static function checkCurrentSession(){
            $conUsers = new ControlUsuarios();

            //Si existe sesion de usuario activa
            if( self::isSessionON() ){
                //Obtiene usuario para actualizar sesion
                $user = $conUsers->getUser_ById( self::getUserId() );

                //Vericia que usuario realmente exista
                //TODO: verificar por estado de usuario y si existe
                if( $user == null || $user == 'error' ) {
                    //reset de sesion
                    self::destroySession();
                }
                else{
                    $conStudens = new ControlEstudiantes();
                    $conStudens->getStudent_ById( self::getStudentId() );
                    //TODO: si no es estudiante, redireccionar
                    if( $user == null || $user == 'error' ) {
                        //reset de sesion
                        self::destroySession();
                    }{
                        //TODO: actualizar datos (user y estudiante)
                    }
                }
            }
        }


		public static function destroySession(){
            unset( $_SESSION['user'] );
            unset( $_SESSION['student'] );
    		session_destroy();
		}


		//---------------- DATOS
		public static function isSessionON(){
			if( isset( $_SESSION['user']['id'] ) )
				return true;
			else 
				return false;
		}


		//--------------------- ROL
		public static function isAdmin(){
			if( self::isSessionON() ){
				if( $_SESSION['user']['role'] == "administrador" )
					return true;
				else
					return false;
			}
			else
				return null;
		}


		public static function isStudent(){
			if( self::isSessionON() ){
				if( $_SESSION['user']['role'] == "estudiante" )
					return true;
				else
					return false;
			}
			else
				return null;
		}


        //--------------------- USUARIO
        public static function getUserId(){
            return $_SESSION['user']['id'];
        }


		//--------------------- ESTUDIANTE
		public static function isTypeSelected(){
			if( self::isSessionON() ){
				if( isset( $_SESSION['student']['type'] ) )
					return true;
				else
					return false;
			}
			else
				return false;
		}

        public static function setStudentType($type){
		    $_SESSION['student']['type'] = $type;
        }


        public static function isAsesor(){
            return ( $_SESSION['student']['type'] == self::$ASESOR )? true : false;
        }

        public static function isAlumno(){
            return ( $_SESSION['student']['type'] == self::$ALUMNO )? true : false;
        }

        public static function getStudentType(){
            return $_SESSION['student']['type'];
        }

        //--------------------- ESTUDIANTE DATOS

        public static function getStudentId(){
            return $_SESSION['student']['id'];
        }

        public static function getStudentName(){
            return $_SESSION['student']['name'];
        }

        /**
         * @return Carrera|int
         */
        public static function getStudentCarrer(){
            return $_SESSION['student']['career'];
        }




    }

 ?>