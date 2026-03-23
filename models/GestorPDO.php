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
        $stmt->bindValue(':casco',$vehiculo->getIncluyeCasco(),PDO::PARAM_BOOL);

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

public function obtenerVehiculo($matricula){
    $sql='SELECT * FROM flota_vehiculos WHERE matricula=:mat';
    $stmt=$this->getConn()->prepare($sql);
    $stmt->bindValue(':mat',$matricula);
    $stmt->execute();

    $res=$stmt->fetch(PDO::FETCH_ASSOC);

    if($res){
        if($res['tipo_vehiculo']=="Coche"){
            return new Coche($res['marca'], $res['modelo'], $res['matricula'], $res['precio_dia'], $res['numero_puertas'], $res['tipo_combustible']);
        }else{
            return new Motocicleta($res['marca'], $res['modelo'], $res['matricula'], $res['precio_dia'], $res['cilindrada'], $res['incluye_casco']);
        }
    }
    return null;
}

public function modificar($vehiculo){
    $sql="UPDATE flota_vehiculos SET marca = :marca, 
    modelo = :modelo, precio_dia = :precio, 
    numero_puertas = :puertas, tipo_combustible = :motor, 
    cilindrada = :cil, incluye_casco = :casco WHERE matricula = :mat";

    $stmt=$this->getConn()->prepare($sql);

    $stmt->bindValue(':marca', $vehiculo->getMarca());
    $stmt->bindValue(':modelo', $vehiculo->getModelo());
    $stmt->bindValue(':precio', $vehiculo->getPrecioDia());
    $stmt->bindValue(':mat', $vehiculo->getMatricula());

    if(get_class($vehiculo)=="Coche"){
        $stmt->bindValue(':puertas', $vehiculo->getNumeroPuertas());
        $stmt->bindValue(':motor', $vehiculo->getTipoCombustible());
        $stmt->bindValue(':cil', null);
        $stmt->bindValue(':casco', null);
    }else{
        $stmt->bindValue(':cil', $vehiculo->getCilindrada());
        $stmt->bindValue(':casco', $vehiculo->getIncluyeCasco(),PDO::PARAM_BOOL);
        $stmt->bindValue(':puertas', null);
        $stmt->bindValue(':motor', null);
    }
    return $stmt->execute();
}
}
?>