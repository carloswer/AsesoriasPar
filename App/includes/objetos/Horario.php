<?php namespace Objetos;

    class Horario{
        
        private $idSchedule;
        private $arrayHoursAndDays;
        private $arraySubjects;
        private $scheduleStatus;

        /**
         * Horario constructor.
         */
        public function __construct(){}

        /**
         * @return mixed
         */
        public function getIdSchedule()
        {
            return $this->idSchedule;
        }

        /**
         * @param mixed $idSchedule
         */
        public function setIdSchedule($idSchedule)
        {
            $this->idSchedule = $idSchedule;
        }


        /**
         * @return array
         */
        public function getArrayHoursAndDays()
        {
            return $this->arrayHoursAndDays;
        }

        /**
         * @param mixed $arrayHoursAndDays
         */
        public function setArrayHoursAndDays($arrayHoursAndDays)
        {
            $this->arrayHoursAndDays = $arrayHoursAndDays;
        }

        /**
         * @return array
         */
        public function getArraySubjects()
        {
            return $this->arraySubjects;
        }

        /**
         * @param array $arraySubjects
         */
        public function setArraySubjects($arraySubjects)
        {
            $this->arraySubjects = $arraySubjects;
        }

        /**
         * @return mixed
         */
        public function getScheduleStatus()
        {
            return $this->scheduleStatus;
        }

        /**
         * @param mixed $scheduleStatus
         */
        public function setScheduleStatus($scheduleStatus)
        {
            $this->scheduleStatus = $scheduleStatus;
        }

    }