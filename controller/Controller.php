<?php

class Controller{
    protected $gestor;

    function __construct($gestor){
        $this->gestor=$gestor;
    }

    public function index(){
        $lista=$this->gestor->listar();

        include "views/listar.php";
    }

    public function alta(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $tipo=$_POST['tipo_vehiculo'];
            if($tipo=="Coche"){
                $vehiculo=new Coche(
                    $_POST['marca'],$_POST['modelo'],$_POST['matricula'], 
                    $_POST['precio_dia'],$_POST['numero_puertas'],$_POST['tipo_combustible']
                );
            }else{
                if(isset($_POST['incluye_casco'])){
                    $casco=true;
                }else{
                    $casco=false;
                }
                $vehiculo=new Motocicleta(
                    $_POST['marca'],$_POST['modelo'],$_POST['matricula'], 
                    $_POST['precio_dia'],$_POST['cilindrada'],$casco
                );
            }
            $this->gestor->anyadir($vehiculo);
            header('Location: index.php');
            exit;
        }
        include 'views/alta.php';
    }

    public function baja(){
        $matricula=$_GET['matricula'];
        $this->gestor->eliminar($matricula);
        header('Location: index.php');
        exit;
    }

    public function editar(){
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $tipo = $_POST['tipo_vehiculo'];
        
        if ($tipo=="Coche") {
            $vehiculo= new Coche($_POST['marca'],$_POST['modelo'],$_POST['matricula'],$_POST['precio_dia'],
            $_POST['numero_puertas'],$_POST['tipo_combustible']);
        } else {
            if(isset($_POST['incluye_casco'])){
                $casco=true;
            }else{
                $casco=false;
            }
            $vehiculo = new Motocicleta($_POST['marca'],$_POST['modelo'],$_POST['matricula'],
            $_POST['precio_dia'],$_POST['cilindrada'],$casco);
        }

        $this->gestor->modificar($vehiculo); 
        header("Location: index.php");
        exit;
        }
        $matricula=$_GET['matricula'];
        $vehiculo=$this->gestor->obtenervehiculo($matricula);
        include 'views/editar.php';
    }
}
?>