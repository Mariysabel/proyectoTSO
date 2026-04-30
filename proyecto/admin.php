<?php
include("conn.php");

//insert
if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];

    $conn->query("INSERT INTO herramientas(nombre, marca, stock, precio)
                  VALUES('$nombre','$marca','$stock','$precio')");
}

//delete
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conn->query("DELETE FROM herramientas WHERE id=$id");
}

//update
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];

    $conn->query("UPDATE herramientas 
                  SET nombre='$nombre', marca='$marca',
                      stock='$stock', precio='$precio'
                  WHERE id=$id");
}

$editar = false;
if (isset($_GET['editar'])) {
    $editar = true;
    $id = $_GET['editar'];
    $res = $conn->query("SELECT * FROM herramientas WHERE id=$id");
    $data = $res->fetch_assoc();
}



//listar
$resultado = $conn->query("SELECT * FROM herramientas");

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD Herramientas</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-100 text-white p-6">

<h1 class="text-3xl font-bold text-orange-500 mb-6">
    Gestión de Herramientas
</h1>


<form method="POST" class="bg-gray-500 p-4 rounded mb-6">
    <input type="text" name="nombre" placeholder="Nombre" required
        class="w-full p-2 mb-2 text-black rounded">

    <input type="text" name="marca" placeholder="Marca"
        class="w-full p-2 mb-2 text-black rounded">

    <input type="number" name="stock" placeholder="Stock"
        class="w-full p-2 mb-2 text-black rounded">

    <input type="number" step="0.01" name="precio" placeholder="Precio"
        class="w-full p-2 mb-2 text-black rounded">

    <button name="guardar"
        class="bg-orange-500 px-4 py-2 rounded hover:bg-orange-600">
        Agregar
    </button>
</form>

<table class="w-full bg-gray-500 rounded">
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

            <td>
                <a href="?eliminar=<?= $row['id'] ?>"
                   onclick="return confirm('¿Eliminar?')"
                   class="bg-red-500 px-2 py-1 rounded">
                   Eliminar
                </a>

                <a href="?editar=<?= $row['id'] ?>"
                    class="bg-orange-500 px-2 py-1 mx-5 rounded">
                    Editar
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>