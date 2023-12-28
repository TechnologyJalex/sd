<?php
// Start the session
session_start();

// Check if the user is not logged in, then redirect to the index page
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Get the current user from the session
$usuarioActual = $_SESSION['usuario'];

// Read user data from the JSON file
$usuarios = json_decode(file_get_contents('usuarios.json'), true);

// Initialize an array to store user data
$datosUsuario = [];

// Find and retrieve the data of the current user
foreach ($usuarios as $usuario) {
    if ($usuario['usuario'] === $usuarioActual) {
        $datosUsuario = $usuario;
        break;
    }
}

// Read FAQ data from the JSON file
$faqData = json_decode(file_get_contents('faq.json'), true);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FAQ - Word Global</title>
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
    color: #000; /* Cambia el color del texto a negro (#000) */
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
        h1 {
    color: #ff0000; /* Cambia el color del texto a rojo (#ff0000) */
}

    </style>
</head>
<body class="bg-dark">
<body class="bg-dark">
<div class="sidebar">
    <h2 class="text-center mb-4">Dashboard</h2>
    
    <ul class="nav flex-column">
        <!-- Sidebar links -->
        <li class="nav-item mb-3">
            <a href="dashboard.php" class="nav-link sidebar-link">Inicio</a>
        </li>
        <li class="nav-item mb-3">
            <a href="referidos.php" class="nav-link sidebar-link">Ver mis referidos</a>
        </li>
        <li class="nav-item">
            <a href="perfil.php" class="nav-link sidebar-link">Ver mi perfil</a>
        </li>
        <li class="nav-item">
            <a href="faq.php" class="nav-link sidebar-link">FAQ</a>
        </li>
        <li class="nav-item">
            <a href="pdf.php" class="nav-link sidebar-link">Documento</a>
        </li>
        <li class="nav-item">
            <a href="arbol.php" class="nav-link sidebar-link">Árbol</a>
        </li>
      
    </ul>
    
    <div class="mt-auto text-center"> <!-- Use the "mt-auto" class to push content to the bottom -->
    <hr class="divider"> <!-- Add a horizontal line as a visual separator -->

    <div class="mt-3">
        <img src="documentos/img/perfil.png" alt="User Photo" class="img-fluid rounded-circle mx-auto d-block mb-3" style="width: 80px; height: 80px;">
        <p class="text-center mb-0">
            <a href="perfil.php" class="text-white text-decoration-none"><?php echo htmlspecialchars($usuarioActual); ?></a>
        </p>    <div class="d-flex justify-content-center">
    <a href="ajustes.php" class="btn btn-success btn-block mt-3 mr-2">Ajustes</a>
    <a href="logout.php" class="btn btn-danger btn-block mt-3">Cerrar sesión</a>
</div>

    </div>
</div>

   
</div>


    <div class="main-content">
        <h1 class="text-center mb-4">Preguntas Frecuentes</h1>
        <div id="accordion">
            <?php
            // Array con las preguntas y respuestas obtenido desde el archivo JSON
            $faq_json = file_get_contents('faq.json');
            $faq = json_decode($faq_json, true);

            // Iterar a través del array para mostrar las preguntas y respuestas usando Bootstrap Accordion
            foreach ($faq as $index => $item) {
            ?>
            <div class="card">
                <div class="card-header" id="heading<?php echo $index; ?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $index; ?>" aria-expanded="true" aria-controls="collapse<?php echo $index; ?>">
                            <?php echo $item['pregunta']; ?>
                        </button>
                    </h5>
                </div>

                <div id="collapse<?php echo $index; ?>" class="collapse" aria-labelledby="heading<?php echo $index; ?>" data-parent="#accordion">
                    <div class="card-body">
                        <?php echo $item['respuesta']; ?>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Agrega los scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
