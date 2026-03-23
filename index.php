<?php
    require_once "autoload.php";
    
    $gestor=new GestorPDO();
    $controller=new Controller($gestor);

    $accion=$_GET['accion'] ?? 'index';

    switch($accion){
        case 'editar':
            $controller->editar();
            break;
        case 'baja':
            $controller->baja();
            break;
        case 'alta':
            $controller->alta();
            break;
        default:
            $controller->index();
    }
?>