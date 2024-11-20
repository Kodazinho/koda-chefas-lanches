<?php

if (isset($_POST['nome']) && isset($_POST['preco']) && isset($_POST['pedidos'])) {
    $nome = $_POST['nome']; // Nome do cliente
    $preco = $_POST['preco']; // Preço
    $pedidos = json_decode($_POST['pedidos'], true); // Converte o JSON para um array

    $database->pedido($nome, $preco, $pedidos);
}
