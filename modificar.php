<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar_usuario'])) {
    $usuarioAModificar = $_POST['modificar_usuario'];
    // Supongamos que recibimos los campos a modificar del formulario y los almacenamos en variables
    $nuevoNombre = $_POST['nuevo_nombre'] ?? '';
    $nuevoApellido = $_POST['nuevo_apellido'] ?? '';
    $nuevaEdad = $_POST['nueva_edad'] ?? '';
    // ... otros campos que desees modificar

    // Obtener usuarios del archivo JSON
    $usuarios = file_get_contents('usuarios.json');
    $usuarios = json_decode($usuarios, true);

    // Buscar el usuario por su ID o algún identificador único
    foreach ($usuarios as $key => $usuario) {
        if ($usuario['usuario'] === $usuarioAModificar) {
            // Actualizar los campos del usuario con los nuevos valores
            $usuarios[$key]['nombre'] = $nuevoNombre;
            $usuarios[$key]['apellido'] = $nuevoApellido;
            $usuarios[$key]['edad'] = $nuevaEdad;
            // ... actualizar otros campos

            // Sobrescribir el archivo usuarios.json con el nuevo array de usuarios
            file_put_contents('usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));

            echo '<p>¡Usuario modificado correctamente!</p>';
            break;
        }
    }
}
?>
