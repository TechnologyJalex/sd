<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cambio de Contraseña</title>
</head>
<body>
    <h1>Cambio de Contraseña</h1>
    <form method="post">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" id="username" placeholder="Ingresa el nombre de usuario"><br><br>
        
        <label for="newPassword">Nueva Contraseña:</label>
        <input type="password" name="newPassword" id="newPassword" placeholder="Ingresa la nueva contraseña"><br><br>
        
        <input type="submit" name="submit" value="Cambiar Contraseña">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username']) && isset($_POST['newPassword'])) {
            $username = $_POST['username'];
            $newPassword = $_POST['newPassword'];

            // Leer el archivo usuarios.json
            $jsonFile = 'usuarios.json';
            $jsonData = file_get_contents($jsonFile);
            $usersData = json_decode($jsonData, true);

            // Buscar el usuario y actualizar la contraseña si se encuentra
            $userIndex = -1;
            foreach ($usersData as $index => $user) {
                if ($user['usuario'] === $username) {
                    $userIndex = $index;
                    break;
                }
            }

            if ($userIndex !== -1) {
                $usersData[$userIndex]['contrasena'] = $newPassword;

                // Guardar los cambios en usuarios.json
                file_put_contents($jsonFile, json_encode($usersData, JSON_PRETTY_PRINT));

                echo "<p>Contraseña para $username actualizada correctamente.</p>";
            } else {
                echo "<p>El usuario $username no fue encontrado.</p>";
            }
        }
    }
    ?>
</body>
</html>
