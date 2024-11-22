<?php

    include 'database/database.php';
    include 'middleware/pedidos.php';
    include 'controller/finalizar.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/script/tailwind.js"></script>
    <title>Koda & Chefas - Pedidos</title>
    <style>
        #pedido-container {
            max-height: 400px;  
            overflow-y: auto;   
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body class="bg-gray-200 font-sans leading-tight">

    <?php include 'partials/header.php'; ?>

    <div class="flex justify-center items-center min-h-[90vh]">
        <div class="bg-white p-8 rounded-lg shadow-md w-[80vw]">
            <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Lista de Pedidos</h2>

            <div id="pedido-container">
                <?php if (count($pedidos) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Ordem do Pedido</th>
                                <th>Nome do Cliente</th>
                                <th>Data do Pedido</th>
                                <th>Preço Total</th>
                                <th>Produtos</th>
                                <th>Finalizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $exibir_pedidos = false; // Variável para controlar se tem pedidos para exibir
                                foreach ($pedidos as $pedido):
                                    // se o pedido tiver finalizado, pula para o próximo
                                    if ($pedido['finalizado'] == true) {
                                        continue;  // Pula este pedido e vai para o próximo
                                    }
                                    $exibir_pedidos = true;  // Se encontrar algum pedido não finalizado, marca como exibir
                            ?>
                                <tr>
                                    <td><?= $pedido['id'] ?></td>
                                    <td><?= $pedido['cliente_nome'] ?></td>
                                    <td><?= $pedido['data_pedido'] ?></td>
                                    <td>R$ <?= $pedido['total'] ?></td>
                                    <td>
                                        <ul>
                                            <?php foreach ($pedido['produtos'] as $produto): ?>
                                                <li><?= $produto['quantidade'] ?>x <?= $produto['nome'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td><a href="/pedidos.php?id=<?= $pedido['id'] ?>"><button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">Finalizar</button></a></td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (!$exibir_pedidos): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-gray-600">Nenhum pedido encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">Nenhum pedido encontrado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer>
    </footer>

</body>

</html>
