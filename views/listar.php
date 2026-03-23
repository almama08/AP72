<html>
    <head>
        <title>Lista de vehículos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
<body>
    <?='<h1>Lista de vehículos disponibles</h1>'?>
    <div class="container-fluid">
        <?='<table class="table table-striped">';?>
        <?='<thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Matrícula</th>
                    <th>Precio/Día</th>
                    <th>Alquiler (7 días)</th>
                    <th>Opciones</th>
                </tr>
            </thead>';?>
        <?php foreach($lista as $vehiculo):?>
            <tr>
                <td><?=$vehiculo->getMarca()?></td>
                <td><?=$vehiculo->getModelo()?></td>
                <td><?=$vehiculo->getMatricula()?></td>
                <td><?=$vehiculo->getPrecioDia()?></td>
                <td>
                    <?=$vehiculo->calcularAlquiler(7)?>€
                </td>
                <td>
                    <a href='index.php?accion=baja&matricula=<?=$vehiculo->getMatricula()?>'>
                        Eliminar
                    </a>
                </td>
                <td>
                    <a href="index.php?accion=editar&matricula=<?= $vehiculo->getMatricula() ?>">
                        Editar
                    </a>
                </td>
            </tr>
        <?php endforeach;?>
        </table>
        <a href="index.php?accion=alta">Añadir Nuevo Vehículo</a>
    </div>
</body>
</html>