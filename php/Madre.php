<?php

require_once "AbstractVacuno.php";

class Madre extends Vacuno {
    public function __construct($caravana, $tipo, $raza, $edad, $peso, $historial, $alta) {
        parent::__construct($caravana, $tipo, $raza, $edad, $peso, $historial, $alta);
    }

    public function guardarEnBD($pdo) {
        try {
            $sql = "INSERT INTO vacunos (caravana, tipo, raza, edad, peso, historial, alta) 
                    VALUES (:caravana, :tipo, :raza, :edad, :peso, :historial, :alta)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':caravana' => $this->getCaravana(),
                ':tipo' => $this->getTipo(),
                ':raza' => $this->getRaza(),
                ':edad' => $this->getEdad(),
                ':peso' => $this->getPeso(),
                ':historial' => $this->GetHistorial(),
                ':alta' => $this->getAlta()->format('Y-m-d H:i:s'),
            ]);
            echo "Vacuno registrado correctamente.";
        } catch (PDOException $e) {
            echo "Error al registrar: " . $e->getMessage();
        }
    }
}

