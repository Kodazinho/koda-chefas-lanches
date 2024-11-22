<?php

if(isset($_GET['id'])){
    $database->finalizar($_GET['id']);
    header('Location: pedidos.php');
}