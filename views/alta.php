<!DOCTYPE html>
<html>
    <head>
        <title>Alta de vehículo</title>
        <meta charset="utf-8">
    </head>
<body>
    <h1>Añadir vehículo</h1>

    <form action="index.php?accion=alta" method="POST">
        <p>
            <label>Tipo de vehículo:</label><br>
            <select name="tipo_vehiculo">
                <option value="Coche">Coche</option>
                <option value="Motocicleta">Motocicleta</option>
            </select>
        </p>
        <p>
            <label>Marca:</label>
            <input type="text" name="marca" required>
        </p>
        <p>
            <label>Modelo:</label>
            <input type="text" name="modelo" required>
        </p>
        <p>
            <label>Matrícula:</label><br>
            <input type="text" name="matricula" required>
        </p>
        <p>
            <label>Precio por Día:</label><br>
            <input type="number"name="precio_dia" required>
        </p>
        <hr>
        <h3>Datos para Coche</h3>
        <p>
            <label>Nº Puertas:</label><br>
            <input type="number" name="numero_puertas">
        </p>
        <p>
            <label>Combustible:</label><br>
            <input type="text" name="tipo_combustible">
        </p>

        <hr>
        <h3>Datos para Moto</h3>
        <p>
            <label>Cilindrada:</label><br>
            <input type="number" name="cilindrada">
        </p>
        <p>
            <label>
                <input type="checkbox" name="incluye_casco"> ¿Incluye Casco?
            </label>
        </p>

        <hr>
        <button type="submit">Guardar Vehículo</button>
        <a href="index.php">Volver al listado</a>
    </form>
</body>
</html>