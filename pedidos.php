<?php

    include 'database/database.php';
    include 'middleware/pedidos.php';

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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pedidos as $pedido): ?>
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
                                </tr>
                            <?php endforeach; ?>
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
