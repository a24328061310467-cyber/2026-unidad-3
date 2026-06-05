<?php
$conexion = new mysqli("localhost", "root", "", "pokedex");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "
SELECT 
p.nombre AS pokemon,
GROUP_CONCAT(DISTINCT t.nombre SEPARATOR ', ') AS tipos,
GROUP_CONCAT(DISTINCT h.nombre SEPARATOR ', ') AS habilidades,
p2.nombre AS evoluciona_a,
e.nivel
FROM pokemon p
LEFT JOIN pokemon_tipos pt ON p.id = pt.pokemon_id
LEFT JOIN tipos t ON pt.tipo_id = t.id
LEFT JOIN pokemon_habilidades ph ON p.id = ph.pokemon_id
LEFT JOIN habilidades h ON ph.habilidad_id = h.id
LEFT JOIN evoluciones e ON p.id = e.pokemon_id
LEFT JOIN pokemon p2 ON e.evoluciona_a = p2.id
GROUP BY p.id
ORDER BY p.nombre;
";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pokédex</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            text-align: center;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            width: 90%;
            background: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }
        th {
            background: #333;
            color: white;
        }
        tr:hover {
            background: #f5f5f5;
        }
    </style>
</head>
<body>

<h1>Pokédex Completa</h1>

<table>
<tr>
    <th>Pokémon</th>
    <th>Tipos</th>
    <th>Habilidades</th>
    <th>Evoluciona a</th>
    <th>Nivel</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()) { ?>
<tr>
    <td><?php echo $fila['pokemon']; ?></td>
    <td><?php echo $fila['tipos']; ?></td>
    <td><?php echo $fila['habilidades']; ?></td>
    <td><?php echo $fila['evoluciona_a'] ? $fila['evoluciona_a'] : '---'; ?></td>
    <td><?php echo $fila['nivel'] ? $fila['nivel'] : '---'; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>