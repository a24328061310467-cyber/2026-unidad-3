<?php
require_once 'conexion.php'; 
include 'header.php';

try {
    $sql = "SELECT * FROM pokemon ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $pokemones = $stmt->fetchAll();
} catch (PDOException $e) {
    $pokemones = [];
}
?>

<div class="container-fluid">
    <h1 class="text-center" style="color: green;">Galería de Pokémon</h1>
    <h2>Jonathan Cruz Ventura</h2>
    <p style="text-align: center;">Consulta de Pokémon registrados</p>

    <div class="cards-grid">
        <?php foreach ($pokemones as $p): ?>
            <div class="x-card">

                <div class="card-header">
                    <?php echo htmlspecialchars($p['nombredelpokemon'] ?? 'Sin Nombre'); ?>
                </div>

                <div class="card-body">
                    <p><strong>ID:</strong> <?php echo htmlspecialchars($p['id']); ?></p>

                    <p><strong>Tipo:</strong> 
                        <?php echo htmlspecialchars($p['tipo'] ?? 'No definido'); ?>
                    </p>

                    <p><strong>Debilidad:</strong> 
                        <?php echo htmlspecialchars($p['debilidad'] ?? 'No definida'); ?>
                    </p>

                    <p><strong>Resistencia:</strong> 
                        <?php echo htmlspecialchars($p['resistencia'] ?? 'No definida'); ?>
                    </p>

                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>