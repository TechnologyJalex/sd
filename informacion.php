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
            margin: 20px;
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
          
         body {
        color: #fff; /* Set text color to white for the entire body */
    }
        /* Estilos adicionales pueden ir aquí */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            padding-top: 3rem;
            background-color: #343a40;
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
        .main-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    color: #fff;
}
        
    </style>
</head>
<body class="bg-dark">
    <div class="referral-list">
        <?php foreach ($productos as $producto) : ?>
            <div class="referral-list-item">
                <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" class="card-img-top rounded-circle" style="max-width: 100px; max-height: 100px;">
                <h4><?php echo $producto['nombre']; ?></h4>
                <p><?php echo $producto['subtitulo']; ?></p>
                <p>Precio: $<?php echo $producto['precio']; ?></p>
                <a href="<?php echo $producto['enlace']; ?>" class="btn btn-primary">
                    <i class="fas fa-shopping-cart fa-icon"></i> <?php echo $producto['boton']; ?>
                </a>
                <p>Cantidad disponible: <?php echo $cantidadPorArticulo[$producto['nombre']]; ?></p>
                <!-- Add more information about productos as needed -->
            </div>
        <?php endforeach; ?>
    </div>

    <h3 class="mt-4">Usuarios:</h3>

   <div class="referral-list">
    <?php foreach ($usuarios as $usuario) : ?>
        <div class="referral-list-item">
            <h4><?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?></h4>
            
            <?php
            // Buscar la cantidad de artículos adquiridos por el usuario actual
            $cantidadArticulosAdquiridos = count(array_filter($productos, function ($producto) use ($usuario) {
                return $producto['idUsuario'] == $usuario['id'];
            }));
            
            echo "<p>Cantidad de artículos adquiridos: {$cantidadArticulosAdquiridos}</p>";
            ?>
            
        
                <i class="fas fa-user fa-icon"></i>
                <!-- Add more information about usuarios as needed -->
            </div>
        <?php endforeach; ?>
    </div>

    <p>Total de productos disponibles: <?php echo $totalProductos; ?></p>

    <!-- Bootstrap JS and additional scripts (if necessary) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Additional scripts can go here -->
</body>
</html>
