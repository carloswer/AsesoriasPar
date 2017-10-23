<?php namespace Excepciones;


use Exception;
use Throwable;

/**
 * Class PersistenciaException Excepciones relaciones con persistencia (Base de datos)
 * @package Excepciones
 */
class PersistenciaException extends Exception {

    /**
     * PersistenciaException constructor.
     * @param string $message mensaje a mostrar
     * @param int $extra mensaje extra a mostrar
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $extra, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message.": ".$extra, $code, $previous);
    }



}