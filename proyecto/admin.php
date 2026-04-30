<?php
include("conn.php");
session_start();

// 🔒 PROTECCIÓN
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$editar = false;
$data = [];

// INSERT
if (isset($_POST['guardar'])) {
    $conn->query("INSERT INTO herramientas(nombre, marca, stock, precio)
                  VALUES('{$_POST['nombre']}','{$_POST['marca']}','{$_POST['stock']}','{$_POST['precio']}')");
}

// DELETE
if (isset($_GET['eliminar'])) {
    $conn->query("DELETE FROM herramientas WHERE id=" . $_GET['eliminar']);
}

// EDITAR (CARGAR DATOS)
if (isset($_GET['editar'])) {
    $editar = true;
    $id = $_GET['editar'];
    $res = $conn->query("SELECT * FROM herramientas WHERE id=$id");
    $data = $res->fetch_assoc();
}

// UPDATE
if (isset($_POST['actualizar'])) {
    $conn->query("UPDATE herramientas SET 
        nombre='{$_POST['nombre']}',
        marca='{$_POST['marca']}',
        stock='{$_POST['stock']}',
        precio='{$_POST['precio']}'
        WHERE id={$_POST['id']}");
}

// LISTAR
$resultado = $conn->query("SELECT * FROM herramientas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Herramientas</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white p-6">

<h1 class="text-3xl font-bold text-orange-500 mb-6">
    Gestión de Herramientas
</h1>

<!-- FORM -->
<form method="POST" class="bg-gray-900 p-4 rounded mb-6">

    <!-- 🔥 ESTE INPUT ES LA CLAVE -->
    <input type="hidden" name="id" value="<?= $data['id'] ?? '' ?>">

    <input type="text" name="nombre" placeholder="Nombre" required
        value="<?= $data['nombre'] ?? '' ?>"
        class="w-full p-2 mb-2 text-black rounded">

    <input type="text" name="marca" placeholder="Marca"
        value="<?= $data['marca'] ?? '' ?>"
        class="w-full p-2 mb-2 text-black rounded">

    <input type="number" name="stock" placeholder="Stock"
        value="<?= $data['stock'] ?? '' ?>"
        class="w-full p-2 mb-2 text-black rounded">

    <input type="number" step="0.01" name="precio" placeholder="Precio"
        value="<?= $data['precio'] ?? '' ?>"
        class="w-full p-2 mb-2 text-black rounded">

    <!-- 🔥 BOTÓN DINÁMICO -->
    <button name="<?= $editar ? 'actualizar' : 'guardar' ?>"
        class="bg-orange-500 px-4 py-2 rounded hover:bg-orange-600">
        <?= $editar ? 'Actualizar' : 'Agregar' ?>
    </button>

</form>

<!-- TABLA -->
<table class="w-full bg-gray-900 rounded">
    <thead class="bg-orange-500 text-black">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
    <?php while($row = $resultado->fetch_assoc()): ?>
        <tr class="text-center border-b border-gray-700 h-10">
            <td><?= $row['id'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['marca'] ?></td>
            <td><?= $row['stock'] ?></td>
            <td>$<?= $row['precio'] ?></td>

            <td class="space-x-2">
                <!-- EDITAR -->
                <a href="?editar=<?= $row['id'] ?>"
                   class="bg-blue-500 px-2 py-1 rounded">
                   Editar
                </a>

                <!-- ELIMINAR -->
                <a href="?eliminar=<?= $row['id'] ?>"
                   onclick="return confirm('¿Eliminar?')"
                   class="bg-red-500 px-2 py-1 rounded">
                   Eliminar
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>