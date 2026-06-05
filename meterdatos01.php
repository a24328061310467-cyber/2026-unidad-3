<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jonathan Cruz Ventura</title>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<!-- Bootstrap 3 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Fuente Lobster -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">

<style>

body{
    font-family:"Lobster Two", sans-serif;
    background-color:#053C5E;
    color:white;
}

h1{
    text-align:center;
    color:yellow;
}

.navbar{
    background-color:#6C427A;
    border:none;
}

.navbar-brand,
.navbar-nav > li > a{
    color:black !important;
}

form{
    width:50%;
    margin:auto;
}

label{
    display:block;
    margin-top:10px;
}

input, textarea{
    width:100%;
    padding:8px;
}

input[type="submit"]{
    background-color:yellow;
    color:black;
    border:none;
}

table{
    width:95%;
    margin:30px auto;
    border-collapse:collapse;
    background:white;
    color:black;
    font-size:12px;
}

th{
    background:#A31621;
    color:white;
    padding:10px;
}

td{
    padding:8px;
    text-align:center;
}

</style>
</head>

<body>

<nav class="navbar navbar-default">
<div class="container">

<div class="navbar-header">
<a class="navbar-brand" href="index.html">Inicio</a>
</div>

<ul class="nav navbar-nav">

<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
Unidad 1 <span class="caret"></span>
</a>

<ul class="dropdown-menu">
<li><a href="mostrar.php">Mostrar Datos</a></li>
<li><a href="meterdatos01.php">Meter Datos</a></li>
</ul>

</li>

<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
Unidad 2 <span class="caret"></span>
</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="relaciones1.php">relaciones</a></li>
<li><a class="dropdown-item" href="pokemon.php">registro pokemon</a></li>
<li><a class="dropdown-item" href="tarjetas.php">pokemon registrados</a></li>
</ul>
</li>

<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
Unidad 3 <span class="caret"></span>
</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="pokedex.html">pokedex</a></li>
<li><a class="dropdown-item" href="peliculas.html">peliculas</a></li>
<li><a class="dropdown-item" href="overwacht.html">Overwatch</a></li>
</ul>
</li>



</div>
</nav>

<h1>Registro de Superhéroes</h1>

<form method="post">

<label>Nombre Real:</label>
<input type="text" name="nombre" required>

<label>Nombre del Personaje:</label>
<input type="text" name="personaje" required>

<label>Altura:</label>
<input type="text" name="altura" required>

<label>Peso:</label>
<input type="text" name="peso" required>

<label>Poderes:</label>
<input type="text" name="poderes" required>

<label>Sexo:</label>
<input type="text" name="sexo" required>

<label>Debilidad:</label>
<input type="text" name="debilidad" required>

<label>Fecha de Creación:</label>
<input type="date" name="fecha_creacion" required>

<label>Biografía:</label>
<textarea name="descripcion" required></textarea>

<input type="submit" value="Guardar Datos">

</form>

<?php

$conexion = new mysqli("localhost","root","","pikachu");

if($conexion->connect_error){
    die("Error de conexión");
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

$nombre=$_POST['nombre'];
$personaje=$_POST['personaje'];
$altura=$_POST['altura'];
$peso=$_POST['peso'];
$poderes=$_POST['poderes'];
$sexo=$_POST['sexo'];
$debilidad=$_POST['debilidad'];
$creacion=$_POST['fecha_creacion'];
$biografia=$_POST['descripcion'];

$sql="INSERT INTO personajes
(nombrereal,personaje,altura,peso,poderes,sexo,debilidad,creacion,biografia)
VALUES
('$nombre','$personaje','$altura','$peso','$poderes','$sexo','$debilidad','$creacion','$biografia')";

$conexion->query($sql);

}

$sql="SELECT * FROM personajes";
$resultado=$conexion->query($sql);

if($resultado->num_rows>0){

echo "<table>";

echo "<tr>
<th>ID</th>
<th>Nombre Real</th>
<th>Personaje</th>
<th>Altura</th>
<th>Peso</th>
<th>Poderes</th>
<th>Sexo</th>
<th>Debilidad</th>
<th>Creación</th>
<th>Biografía</th>
</tr>";

while($row=$resultado->fetch_assoc()){

echo "<tr>";

echo "<td>".$row["id"]."</td>";
echo "<td>".$row["nombrereal"]."</td>";
echo "<td>".$row["personaje"]."</td>";
echo "<td>".$row["altura"]."</td>";
echo "<td>".$row["peso"]."</td>";
echo "<td>".$row["poderes"]."</td>";
echo "<td>".$row["sexo"]."</td>";
echo "<td>".$row["debilidad"]."</td>";
echo "<td>".$row["creacion"]."</td>";
echo "<td>".$row["biografia"]."</td>";

echo "</tr>";

}

echo "</table>";

}

$conexion->close();

?>

</body>
</html>
