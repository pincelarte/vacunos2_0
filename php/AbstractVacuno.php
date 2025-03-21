<?php

abstract class Vacuno{

    private $caravana;
    private $tipo;
    private $raza;
    private $edad;
    private $peso;
    private $historial;
    private $alta;

    public function __construct($caravana, $tipo, $raza, $edad, $peso, $historial, $alta)
    {
        $this->caravana = $caravana;
        $this->tipo = $tipo;
        $this->raza = $raza;
        $this->edad = $edad;
        $this->peso = $peso;
        $this->historial = $historial;
        $this->alta = $alta;
        
    }

    public function getCaravana(){
        return $this->caravana;
    }

    public function setCaravana($caravana)
    {
        $this->caravana = $caravana;
    }

    public static function eliminarVacuno($caravana)
    {
        global $pdo;

        $sql = "DELETE FROM vacunos WHERE caravana = :caravana";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":caravana", $caravana, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function getRaza(){
        return $this->raza;
    }

    public function setRaza($raza){
        $this->raza = $raza;
    }

    public function getEdad(){
        return $this->edad;
    }

    public function setEdad($edad){
        $this->edad = $edad;
    }

    public function getPeso(){
        return $this->peso;
    }

    public function setPeso($peso){
        $this->peso = $peso;
    }

    public function getHistorial(){
        return $this->historial;
    }

    public function setHistorial($historial){
        $this->historial = $historial;
    }

    public function getAlta(){
        return $this->alta;
    }

    public function setAlta($alta){
        $this->alta = $alta;
    }

    public function guardarEnBD($pdo) {
    try {
        global $mensaje;
        $caravana = $this->getCaravana();
        // Verifico la caravana
        $sqlCheck = "SELECT COUNT(*) FROM vacunos WHERE caravana = :caravana";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->execute([':caravana' => $this->getCaravana()]);
        if ($stmtCheck->fetchColumn() > 0) {
            $mensaje = "<span style='color: red; font-weight: bold;'>⚠ Error: La caravana <strong>$caravana</strong> ya está en uso</span>";
            return;
        }

        
        $sql = "INSERT INTO vacunos (caravana, tipo, raza, edad, peso, historial, alta) 
                VALUES (:caravana, :tipo, :raza, :edad, :peso, :historial, :alta)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':caravana' => $this->getCaravana(),
            ':tipo' => $this->getTipo(),
            ':raza' => $this->getRaza(),
            ':edad' => $this->getEdad(),
            ':peso' => $this->getPeso(),
            ':historial' => $this->getHistorial(),
            ':alta' => $this->getAlta()->format('Y-m-d H:i:s')
        ]);

        $mensaje = "Vacuno {$this->tipo} con caravana {$this->caravana} registrado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error al guardar: " . $e->getMessage();
    }
}

}

