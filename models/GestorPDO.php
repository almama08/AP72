<?php

class GestorPDO extends Connection{

public function __construct(){
    parent::__construct();
}

public function listar(){
    $lista=[];
    $consulta='SELECT * FROM flota_vehiculos';
    $rtdo=$this->getConn()->query($consulta);
    while($value=$rtdo->fetch(PDO::FETCH_ASSOC)){
        if($value['tipo_vehiculo']=='Coche'){
            $vehiculo=new Coche(
                $value['marca'],
                $value['modelo'],
                $value['matricula'], 
                $value['precio_dia'], 
                $value['numero_puertas'], 
                $value['tipo_combustible'], 
                $value['id']
            );
        }else{
            $vehiculo=new Motocicleta(
                $value['marca'],
                $value['modelo'],
                $value['matricula'], 
                $value['precio_dia'], 
                $value['cilindrada'], 
                $value['incluye_casco'], 
                $value['id']
            );
        }
        $lista[]=$vehiculo;
    }
    return $lista;
}

public function anyadir($vehiculo){
    $sql='INSERT INTO flota_vehiculos (marca, modelo, matricula, precio_dia, tipo_vehiculo, numero_puertas, tipo_combustible, cilindrada, incluye_casco)
    VALUES (:marca, :modelo, :matricula, :precio, :tipo, :puertas, :motor, :cil, :casco)';
    $stmt=$this->getConn()->prepare($sql);

    $stmt->bindValue(':marca',$vehiculo->getMarca());
    $stmt->bindValue(':modelo',$vehiculo->getModelo());
    $stmt->bindValue(':matricula',$vehiculo->getMatricula());
    $stmt->bindValue(':precio',$vehiculo->getPrecioDia());

    if(get_class($vehiculo)=="Coche"){
        $stmt->bindValue(':tipo','Coche');
        $stmt->bindValue(':puertas',$vehiculo->getNumeroPuertas());
        $stmt->bindValue(':motor',$vehiculo->getTipoCombustible());

        $stmt->bindValue(':cil',null);
        $stmt->bindValue(':casco',null);
    }else{
        $stmt->bindValue(':tipo','Motocicleta');
        $stmt->bindValue(':cil',$vehiculo->getCilindrada());
        $stmt->bindValue(':casco',$vehiculo->getIncluyeCasco());

        $stmt->bindValue(':puertas',null);
        $stmt->bindValue(':motor',null);
    }
    return $stmt->execute();
}

public function eliminar($matricula){
    $sql='DELETE FROM flota_vehiculos WHERE matricula=:mat';
    $stmt=$this->getConn()->prepare($sql);
    $stmt->bindValue(':mat',$matricula);
    return $stmt->execute();
}
}
?>