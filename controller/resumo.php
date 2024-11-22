<?php

// pega todos os pedidos
    $pedidos_totais = $database->pedidos();
    $lucro_total = 0;
    foreach($pedidos_totais as $pedido){
        // filtra pelos pedidos finalizados
        if($pedido['finalizado']){
            $lucro_total += $pedido['total'];
        }
    }