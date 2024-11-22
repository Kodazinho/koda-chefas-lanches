<?php

if(isset($_GET['del'])){
    $database->deletar($_GET['del']);
    header('Location: editarprodutos.php');
}
