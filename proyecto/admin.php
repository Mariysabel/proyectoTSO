<?php
include("conn.php");
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$editar = false;
$data = [];

if (isset($_POST['guardar'])) {
    $conn->query("INSERT INTO herramientas(nombre, marca, stock, precio)
                  VALUES('{$_POST['nombre']}','{$_POST['marca']}','{$_POST['stock']}','{$_POST['precio']}')");
    header("Location: admin.php");
    exit();
}

if (isset($_GET['eliminar'])) {
    $conn->query("DELETE FROM herramientas WHERE id=" . $_GET['eliminar']);
    header("Location: admin.php");
    exit();
}

if (isset($_POST['actualizar'])) {
    $conn->query("UPDATE herramientas SET 
        nombre='{$_POST['nombre']}',
        marca='{$_POST['marca']}',
        stock='{$_POST['stock']}',
        precio='{$_POST['precio']}'
        WHERE id={$_POST['id']}");
    header("Location: admin.php");
    exit();
}

if (isset($_GET['editar'])) {
    $editar = true;
    $id = $_GET['editar'];
    $res = $conn->query("SELECT * FROM herramientas WHERE id=$id");
    $data = $res->fetch_assoc();
}

$resultado = $conn->query("SELECT * FROM herramientas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Herramientas</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-200 text-white p-6">

<h1 class="text-3xl font-bold text-orange-500 mb-6">
    Gestión de Herramientas
</h1>

<form method="POST" action="<?= $editar ? '?editar='.$data['id'] : '' ?>" class="bg-gray-600 p-4 rounded-15 mb-6">

    <input type="hidden" name="id" value="<?= $data['id'] ?? '' ?>">

    <input type="text" placeholder="Nombre" name="nombre" required
        value="<?= $data['nombre'] ?? '' ?>"
        class="w-full p-2 mb-2 text-black rounded">

    <input type="text" placeholder="Marca" name="marca"
        value="<?= $data['marca'] ?? '' ?>"
        class="w-full p-2 mb-2 text-black rounded">

    <input type="number" placeholder="Stock disponible" name="stock"
        value="<?= $data['stock'] ?? '' ?>"
        class="w-full p-2 mb-2 text-black rounded">

    <input type="number" step="0.01" placeholder="Precio de venta" name="precio"
        value="<?= $data['precio'] ?? '' ?>"
        class="w-full p-2 mb-2 text-black rounded">

    <button name="<?= $editar ? 'actualizar' : 'guardar' ?>"
        class="bg-orange-500 px-4 py-2 rounded hover:bg-orange-600">
        <?= $editar ? 'Actualizar' : 'Agregar' ?>
    </button>

</form>

<table class="w-full bg-gray-800 rounded-15">
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
        <tr class="text-center border-b border-gray-700 h-10 hover:bg-gray-500">
            <td><?= $row['id'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['marca'] ?></td>
            <td><?= $row['stock'] ?></td>
            <td>$<?= $row['precio'] ?></td>

            <td class="space-x-2">
                <a href="?editar=<?= $row['id'] ?>"
                   class="bg-orange-500 px-2 py-1 rounded hover:bg-orange-600">
                   Editar
                </a>

                <a href="?eliminar=<?= $row['id'] ?>"
                   onclick="return confirm('¿Eliminar?')"
                   class="bg-red-500 px-2 py-1 rounded hover:bg-orange-600">
                   Eliminar
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>