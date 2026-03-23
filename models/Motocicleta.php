<?php

class Motocicleta extends Vehiculo{
    private $cilindrada;
    private $incluyeCasco;

    function __construct($marca,$modelo,$matricula,$precioDia,$cilindrada,bool $incluyeCasco,$id=null){
        parent::__construct($marca,$modelo,$matricula,$precioDia,$id);
        $this->cilindrada=$cilindrada;
        $this->incluyeCasco=$incluyeCasco;
    }

    public function getCilindrada() {
        return $this->cilindrada;
    }

    public function setCilindrada($cilindrada){
        $this->cilindrada = $cilindrada;
    }

    public function getIncluyeCasco(){
        return $this->incluyeCasco;
    }

    public function setIncluyeCasco($incluyeCasco){
        $this->incluyeCasco = $incluyeCasco;
    }

    public function calcularAlquiler($dias){
        $total=parent::calcularAlquiler($dias);
        if($this->incluyeCasco){
            $total+=10;
        }
        return $total;
    }
}
?>