<?php

    //Configuracion para UTF-8
    // header('Content-Type: text/html; charset=UTF-8');

    //------------------
    //  DEBUG
    //  0 = Desactivar
    //  1 = Warning / Errors
    //  2 = Errors / Warning / Notices
    //  3 = Errors / Warning / Notices and autoload debug
    //------------------
    define("DEBUG", 1);

    if( DEBUG == 1 )
        error_reporting(0);
    else if( DEBUG == 1 )
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
    else if( DEBUG >= 2 )
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);



    //------------------
    //  VARIABLES Y CONSTANTES
    //------------------
    $tituloPagina = "Default";


    //----------------  Directorios
    define("DS", DIRECTORY_SEPARATOR);
    define('ROOT_PATH', __DIR__ );
    define("VENDOR_PATH",  ROOT_PATH . DS . "vendor");
    define("INC_PATH",  ROOT_PATH . DS . "includes");
    define("TEMPLATE_PATH", INC_PATH . DS . "template");
    define('EST_PATH',  ROOT_PATH . DS . "estudiantes");

    
    //------------------
    //  INCLUDES Y REQUIRES
    //------------------
    include_once INC_PATH . DS . "autoload.php";
    include_once VENDOR_PATH. DS ."autoload.php";




    //------------variable para HREF and SRC de HTML
    // define('ROOT_REF', "");
    define('ROOT_REF',          "/www/asesoriaspar/app");
    // Assets
    define('ASSETS_REF',    ROOT_REF .   "/assets");
    define('MEDIA_REF',     ASSETS_REF . "/media");
    define('JS_REF',        ASSETS_REF . "/js");
    define('STYLE_REF',     ASSETS_REF . "/stylesheet");
    define('VENDOR_REF',      ASSETS_REF.  "/vendor");
    //Directorios
    define('ADMIN_REF',    ROOT_REF.  "/administrador");
    define('EST_REF',      ROOT_REF.  "/estudiante");
    



?>