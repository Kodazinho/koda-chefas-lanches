<?php

    include 'database/database.php';
    include 'middleware/pedidos.php';
    include 'controller/resumo.php'; 

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/script/tailwind.js"></script>
    <title>Koda & Chefas - Resumo</title>
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
            <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Estatisticas da Loja</h2>

            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Resumo Financeiro</h3>

                <div class="flex justify-between text-lg font-medium">
                    <p>Total de Pedidos:</p>
                    <p><?= count($pedidos) ?> Pedidos</p>
                </div>
                <div class="flex justify-between text-lg font-medium mt-2">
                    <p>Lucro Total:</p>
                    <p>R$ <?= number_format($lucro_total, 2, ',', '.') ?></p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Histórico de Pedidos</h3>

                <div id="pedido-container">
                    <?php if (count($pedidos) > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Ordem do Pedido</th>
                                    <th>Nome do Cliente</th>
                                    <th>Data do Pedido</th>
                                    <th>Preço Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pedidos as $pedido): ?>
                                    <tr>
                                        <td><?= $pedido['id'] ?></td>
                                        <td><?= $pedido['cliente_nome'] ?></td>
                                        <td><?= $pedido['data_pedido'] ?></td>
                                        <td>R$ <?= $pedido['total'] ?></td>
                                        <td><?= $pedido['finalizado'] ? 'Finalizado' : 'Em Andamento'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center">Nenhum pedido registrado.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <footer>
    </footer>

</body>

</html>
