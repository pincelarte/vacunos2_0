<?php

require_once "AbstractVacuno.php";

class Toro extends Vacuno
{
    public function __construct($caravana, $tipo, $raza, $edad, $peso, $historial, $alta)
    {
        parent::__construct($caravana, $tipo, $raza, $edad, $peso, $historial, $alta);
    }
}
