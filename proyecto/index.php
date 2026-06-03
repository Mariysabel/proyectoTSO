<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trupper TSO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen flex items-center justify-center overflow-hidden">

    <div class="absolute inset-0">
        <img src="resources/img/fondo.jpg"
             class="w-full h-full object-cover">
    </div>

    <div class="absolute inset-0 bg-black/75"></div>

    <div class="relative z-10 max-w-5xl px-6 py-10 text-white">

        <div class="text-center mb-12">

            <h1 class="text-5xl md:text-7xl font-extrabold text-orange-500 tracking-wide">
                Examen ters
            </h1>

            <div class="w-28 h-1 bg-orange-500 mx-auto mt-4 mb-5 rounded-full"></div>


        </div>

        <div class="grid md:grid-cols-2 gap-10 mb-12">

            <div>

                <h2 class="text-3xl font-bold text-orange-400 mb-4">
                    Misión
                </h2>

                <p class="text-lg leading-relaxed text-gray-200">
                    Brindar productos y servicios de alta calidad para satisfacer
                    las necesidades de nuestros clientes, manteniendo innovación,
                    compromiso y mejora continua.
                </p>

            </div>

            <div>

                <h2 class="text-3xl font-bold text-orange-400 mb-4">
                    Visión
                </h2>

                <p class="text-lg leading-relaxed text-gray-200">
                    Ser la ferretería líder en México y América Latina,
                    reconocida por la excelencia de nuestros productos
                    y la confianza de nuestros clientes.
                </p>

            </div>

        </div>

        <div class="text-center mb-12">

            <h2 class="text-3xl font-bold text-orange-400 mb-6">
                Productos
            </h2>

            <div class="flex flex-wrap justify-center gap-4 text-lg">

                <span class="border border-orange-500 px-5 py-2 rounded-full">
                    Herramientas
                </span>

                <span class="border border-orange-500 px-5 py-2 rounded-full">
                    Material eléctrico
                </span>

                <span class="border border-orange-500 px-5 py-2 rounded-full">
                    Tornillería
                </span>

                <span class="border border-orange-500 px-5 py-2 rounded-full">
                    Construcción
                </span>

                <span class="border border-orange-500 px-5 py-2 rounded-full">
                    Plomería
                </span>

            </div>

        </div>

        <div class="text-center">

            <a href="login.php"
               class="inline-block bg-orange-500 hover:bg-orange-600 px-8 py-3 rounded-xl text-lg font-bold transition duration-300 shadow-lg">
                Iniciar sesión
            </a>

        </div>

    </div>

</body>
</html>