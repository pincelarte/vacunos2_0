<?php

require_once "AbstractVacuno.php";

class Madre extends Vacuno {
    public function __construct($caravana, $tipo, $raza, $edad, $peso, $historial, $alta) {
        parent::__construct($caravana, $tipo, $raza, $edad, $peso, $historial, $alta);
    }

    
}

