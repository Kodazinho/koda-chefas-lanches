<?php

include 'database/database.php';
include 'middleware/produtos.php';
include 'template/produto.php';
include 'controller/pedido.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/script/tailwind.js"></script>
    <title>Koda & Chefas - Pedidos</title>
</head>

<body class="bg-gray-200 font-sans leading-tight">

    <?php
    include 'partials/header.php'
    ?>

    <div class="flex justify-center items-center min-h-[90vh]">
        <div class="bg-white p-8 rounded-lg shadow-md w-[80vw]">
            <h2 id="alerta" class="text-2xl font-semibold text-center text-gray-700 mb-6">Registro do Pedido</h2>

            <form action="" id="pedido" method="POST">
                <div class="mb-4">
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Cliente</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite o nome do cliente" required
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="produto" class="block text-sm font-medium text-gray-700">Produtos</label>
                    <div class="max-h-[40vh] gap-5 flex flex-col mb-3">
                    <?php
                    // verificar se existe produtos registrados
                    if ($produtos->num_rows > 0) {
                        $items = 0;
                        $total = 0;

                        // foreach para registrar todos produtos no form
                        foreach ($produtos as $row) {
                            $items++;
                            $total++;

                            //inicia uma div para poder ficar esteticamente bonito no html
                            if ($items == 1) {
                                echo "<div class='w-full flex items-center justify-around'>";
                            }

                            //chama função para pegar o html formatado dos produtos

                            echo produto($row);


                            // fecha a div se ja tiver 3 itens dentro
                            if ($items == 3 || $total == $produtos->num_rows) {
                                echo "</div>";
                                // zera a contagem de itens na div
                                $items = 0;
                            }
                        }
                    } else {
                        // caso não tenha itens, coloca a mensagem de sem produtos.
                        echo "<p class='font-semibold'>Nenhum produto encontrado.</p>";
                    }

                    
                    // declara variavel em Javascript usando php.
                    echo "<script> var produtos = []; \n";
                        foreach($produtos as $row){
                            echo "produtos[" . $row['id'] . "] = {preco: " . $row['preco'] . ", quantidade: 0, id: " . $row['id'] . "}; \n";
                        }
                    echo "</script>"
                     
                    ?>
                    </div>

                </div>

                <div class="mt-6 text-center">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <script src="assets/script/pedido.js"></script>
    </footer>
</body>

</html>