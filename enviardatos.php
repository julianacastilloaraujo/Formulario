<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muestra de datos en BBDD</title>
    <style type="text/css">
        table {
            border: solid 2px #7e7c7c;
            border-collapse: collapse;
        }

        th, h1 {
            background-color: #edf797;
        }

        td,
        th {
            border: solid 1px #7e7c7c;
            padding: 2px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php

$user = "root";
$pass = "";
$host = "localhost";

$conexion = mysqli_connect($host, $user, $pass);

if(!$conexion) {
    die("No se ha podido conectar con el servidor: " . mysqli_error());
}

$datab = "formulario";
$db = mysqli_select_db($conexion, $datab);

if(!$db) {
    die("No se ha podido encontrar la Tabla: " . mysqli_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edad = $_POST["edad"];
    $kilogramos = $_POST["kilogramos"];
    $colesterol = $_POST["colesterol"];
    $hemoglobina = $_POST["hemoglobina"];

    $instruccion_SQL = "INSERT INTO tabla (edad, kilogramos, colesterol, hemoglobina)
                         VALUES ('$edad', '$kilogramos', '$colesterol', '$hemoglobina')";

    $resultado = mysqli_query($conexion, $instruccion_SQL);

    if (!$resultado) {
        die("Error al insertar datos: " . mysqli_error($conexion));
    }
}

$consulta = "SELECT * FROM tabla";

$result = mysqli_query($conexion, $consulta);

if (!$result) {
    die("No se ha podido realizar la consulta: " . mysqli_error($conexion));
}

echo "<table>";
echo "<tr>";
echo "<th>edad</th>";
echo "<th>kilogramos</th>";
echo "<th>colesterol</th>";
echo "<th>hemoglobina</th>";
echo "</tr>";

while ($colum = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $colum['edad'] . "</td><td>" . $colum['kilogramos'] . "</td><td>" . $colum['colesterol'] . "</td><td>" . $colum['hemoglobina'] . "</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_close($conexion);
echo '<a href="index.html"> Atras</a>';

?>
</body>
</html>
