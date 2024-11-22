<?php

include 'database/database.php';
include 'middleware/produtos.php';
include 'controller/editarproduto.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/script/tailwind.js"></script>
    <title>Koda & Chefas Lanches - Editar</title>
</head>

<body class="bg-gray-100 font-sans leading-tight">

    <?php include 'partials/header.php'; ?>

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-[80vw]">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Gestão de Produtos</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
                <?php
                // Verificar se existem produtos registrados
                if ($produtos->num_rows > 0) {
                    foreach ($produtos as $produto) {
                        $imagemBase64 = $produto['imagem_base64'];
                        $nomeProduto = $produto['nome'];
                        $preco = number_format($produto['preco'], 2, ',', '.');

                        echo "
                        <div class='relative flex flex-col items-center justify-center bg-cover bg-center h-[30vh] rounded-lg shadow-md' 
                             style='background-image: url(\"data:image/jpeg;base64,$imagemBase64\");'>
                            <div class='absolute bottom-0 bg-gradient-to-t from-black to-transparent w-full text-center p-3 rounded-b-lg'>
                                <h2 class='text-white text-sm font-semibold'>$nomeProduto</h2>
                                <p class='text-white text-xs'>R$ $preco</p>
                            </div>
                            <div class='absolute top-2 right-2 flex gap-2'>
                                <a href='configurarproduto.php?edit={$produto['id']}'
                                   class='h-10 w-10 bg-blue-500 text-white p-2 rounded-full shadow-md hover:bg-blue-600 transition-transform duration-200'
                                   title='Editar'>
                                    ✏️
                                </a>
                                <a href='editarprodutos.php?del={$produto['id']}'
                                   class='h-10 w-10 bg-red-500 text-white p-2 rounded-full shadow-md hover:bg-red-600 transition-transform duration-200'
                                   title='Deletar'>
                                    🗑️
                                </a>
                            </div>
                        </div>
                        ";
                    }
                } else {
                    echo "<p class='text-center text-gray-600 font-semibold'>Nenhum produto encontrado.</p>";
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>
