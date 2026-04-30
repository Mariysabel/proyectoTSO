<?php
session_start();

$usuario_correcto = "23161072@itoaxaca.edu.mx";
$password_correcto = "23161072ITSO";

$error = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($usuario === $usuario_correcto && $password === $password_correcto) {
        $_SESSION['usuario'] = $usuario;
        header("Location: admin.php");
        exit();
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-orange-500/80 to-black/90 flex items-center justify-center h-screen">

    <form method="POST" class="bg-white p-8 rounded-2xl shadow-md w-80">
        <h2 class="text-2xl font-bold mb-6 text-center">Iniciar sesión</h2>

        <input type="text" name="usuario" placeholder="Usuario"
            class="w-full p-2 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>

        <input type="password" name="password" placeholder="Contraseña"
            class="w-full p-2 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>

        <button type="submit"
            class="w-full bg-orange-500 text-white p-2 rounded-lg hover:bg-orange-600">
            Entrar
        </button>

        <?php if ($error): ?>
            <p class="text-red-500 mt-3 text-sm text-center">Datos incorrectos</p>
        <?php endif; ?>
    </form>

</body>
</html>