<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mostrar Datos</title>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Fuente -->
<link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">

<style>

body{
background:#A8DADC;
font-family:"Lobster Two", sans-serif;
}

/* BARRA */
.navbar{
background:white;
border:none;
}

.navbar-brand,
.navbar-nav > li > a{
color:black !important;
}

h1{
text-align:center;
color:#E63946;
}

/* TABLA */

table{
width:95%;
margin:30px auto;
border-collapse:collapse;
background:white;
box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

th{
background:#1D3557;
color:white;
padding:12px;
}

td{
padding:10px;
text-align:center;
}

tr:nth-child(even){
background:#f2f2f2;
}

tr:hover{
background:#e0f2f1;
}

img{
border-radius:8px;
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

</ul>
</div>
</nav>

<h1>Aquí voy a mostrar mi tabla</h1>

<?php

$conexion=new mysqli("localhost","root","","pikachu");

if($conexion->connect_error){
die("Error de conexión");
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
<th>Imagen</th>
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

echo "<td>";

if(!empty($row["imagen"])){
echo "<img src='data:image/jpeg;base64," . base64_encode($row["imagen"]) . "' width='100'>";
}else{
echo "Sin Imagen";
}

echo "</td>";

echo "</tr>";

}

echo "</table>";

}else{

echo "<p style='text-align:center;font-size:20px;'>No hay datos</p>";

}

$conexion->close();

?>

</body>
</html>