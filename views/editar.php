<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Vehículo</title>
</head>
<body>
    <h1>Modificar datos del Vehículo</h1>

    <form action="index.php?accion=editar" method="POST">
        <input type="hidden" name="tipo_vehiculo" value="<?= get_class($vehiculo) ?>">
        <p>
            <label>Marca:</label>
            <input type="text" name="marca" value="<?= $vehiculo->getMarca() ?>" required>
        </p>
        <p>
            <label>Modelo:</label>
            <input type="text" name="modelo" value="<?= $vehiculo->getModelo() ?>" required>
        </p>
        <p>
            <label>Matrícula (No editable):</label>
            <input type="text" name="matricula" value="<?= $vehiculo->getMatricula() ?>" readonly>
        </p>
        <p>
            <label>Precio por día:</label>
            <input type="number" step="0.01" name="precio_dia" value="<?= $vehiculo->getPrecioDia() ?>" required>
        </p>
        <?php if (get_class($vehiculo) === 'Coche'): ?>
            <p>
                <label>Número de Puertas:</label>
                <input type="number" name="numero_puertas" value="<?= $vehiculo->getNumeroPuertas() ?>">
            </p>
            <p>
                <label>Tipo de Combustible:</label>
                <input type="text" name="tipo_combustible" value="<?= $vehiculo->getTipoCombustible() ?>">
            </p>
        <?php elseif (get_class($vehiculo) === 'Motocicleta'): ?>
            <p>
                <label>Cilindrada:</label>
                <input type="number" name="cilindrada" value="<?= $vehiculo->getCilindrada() ?>">
            </p>
            <p>
                <label>¿Incluye Casco?:</label>
                <?php 
                    $checked = $vehiculo->getIncluyeCasco() ? "checked" : ""; 
                ?>
                <input type="checkbox" name="incluye_casco" <?= $checked ?>>
            </p>
        <?php endif; ?>
        <hr>
        <button type="submit">Guardar Cambios</button>
        <a href="index.php">Cancelar y Volver</a>
    </form>
</body>
</html>