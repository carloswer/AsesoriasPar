<?php namespace Objetos;

    class Asesoria{

        private $id;
        private $alumno;
        private $asesor;
        private $subject;
        private $date;
        private $register_date;
        private $hour;
        private $description;
        private $status;


        public function __construct(){}

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return Estudiante
         */
        public function getAlumno()
        {
            return $this->alumno;
        }

        /**
         * @param Estudiante $alumno
         */
        public function setAlumno($alumno)
        {
            $this->alumno = $alumno;
        }

        /**
         * @return Estudiante
         */
        public function getAsesor()
        {
            return $this->asesor;
        }

        /**
         * @param Estudiante $asesor
         */
        public function setAsesor($asesor)
        {
            $this->asesor = $asesor;
        }

        /**
         * @return Materia
         */
        public function getSubject()
        {
            return $this->subject;
        }

        /**
         * @param Materia $subject
         */
        public function setSubject($subject)
        {
            $this->subject = $subject;
        }

        /**
         * @return mixed
         */
        public function getDate()
        {
            return $this->date;
        }

        /**
         * @param mixed $date
         */
        public function setDate($date)
        {
            $this->date = $date;
        }

        /**
         * @return mixed
         */
        public function getRegisterDate()
        {
            return $this->register_date;
        }

        /**
         * @param mixed $register_date
         */
        public function setRegisterDate($register_date)
        {
            $this->register_date = $register_date;
        }

        /**
         * @return mixed
         */
        public function getHour()
        {
            return $this->hour;
        }

        /**
         * @param mixed $hour
         */
        public function setHour($hour)
        {
            $this->hour = $hour;
        }

        /**
         * @return mixed
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * @param mixed $description
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }

        /**
         * @return array
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * @param array $status
         */
        public function setStatus($status)
        {
            $this->status = $status;
        }



    }