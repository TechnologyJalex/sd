<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuarioActual = $_SESSION['usuario'];

// Load user data from JSON file
$usuarios = json_decode(file_get_contents('data/usuarios.json'), true);

// Load product data from JSON file
$productos = json_decode(file_get_contents('data/articulos.json'), true);

// Contar la cantidad de cada artículo y calcular el total
$cantidadPorArticulo = [];
$totalProductos = 0;

foreach ($productos as $producto) {
    $cantidad = isset($cantidadPorArticulo[$producto['nombre']]) ? $cantidadPorArticulo[$producto['nombre']] : 0;
    $cantidadPorArticulo[$producto['nombre']] = $cantidad + 1;
    $totalProductos++;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Árbol Binario de Referidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ez0oCrFNt0sN6pUG6AZMfhY1tGqOx1fRN+wl4z5eVOFl5aCWbYAAZaR8z3KpPaa" crossorigin="anonymous">
    <!-- Estilos adicionales -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #343a40;
            color: #fff;
        }

        .tree-node {
            border: 2px solid #3498db;
            padding: 8px;
            margin: 4px;
            display: inline-block;
            background-color: #ecf0f1;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .tree-connection {
            border-left: 2px solid #3498db;
            height: 20px;
            margin-left: 10px;
            margin-right: 10px;
            display: inline-block;
        }

        .referral-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-gap: 20px;
            margin-top: 20px;
        }

        .referral-list-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
        }

        .referral-link {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            padding-top: 3rem;
            background-color: #212529;
            color: #fff;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .sidebar-link {
            color: #fff;
            text-decoration: none;
        }

        .sidebar-link:hover {
            color: #f8f9fa;
        }

        .product-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#" class="sidebar-link">Dashboard</a>
        <a href="#" class="sidebar-link">Profile</a>
        <a href="#" class="sidebar-link">Products</a>
        <a href="#" class="sidebar-link">Referals</a>
        <a href="#" class="sidebar-link">Logout</a>
    </div>

    <div class="main-content">
        <h3>Referral Tree:</h3>
        <div class="tree-node">
            <i class="fas fa-user"></i> <?php echo $usuarioActual; ?>
            <div class="tree-connection"></div>
        </div>

        <!-- Display referral tree (customize as needed) -->
        <?php foreach ($usuarios as $usuario) : ?>
            <div class="tree-node">
                <i class="fas fa-user"></i> <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>
                <div class="tree-connection"></div>
            </div>
        <?php endforeach; ?>

        <h3 class="mt-4">Productos:</h3>

        <div class="referral-list">
            <?php foreach ($productos as $producto) : ?>
                <div class="referral-list-item">
                    <!-- Your existing product display code -->

                    <!-- Additional information about productos as needed -->
                    <p>Cantidad disponible: <?php echo $cantidadPorArticulo[$producto['nombre']]; ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <p>Total de productos disponibles: <?php echo $totalProductos; ?></p>

        <!-- Bootstrap JS and additional scripts (if necessary) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Additional scripts can go here -->
    </div>
</body>
</html>
