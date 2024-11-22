<?php

    include 'database/database.php';
    include 'controller/produtos.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/script/tailwind.js"></script>
    <title>Koda & Chefas - Produtos</title>

</head>

<body class="bg-gray-200 font-sans leading-tight">

        <?php
            include 'partials/header.php'
        ?>

    <div class="flex justify-center items-center min-h-[90vh]">
        <div class="bg-white p-8 rounded-lg shadow-md w-[80vw]">
            <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Cadastro de Produto</h2>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Produto</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" required
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="foto" class="block text-sm font-medium text-gray-700">Foto do Produto</label>
                    <input type="file" id="foto" name="foto" accept="image/*" required
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="preco" class="block text-sm font-medium text-gray-700">Preço</label>
                    <input type="number" step="0.01" id="preco" name="preco" placeholder="Digite o preço do produto" required
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mt-6 text-center">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer>
    </footer>

</body>

</html>