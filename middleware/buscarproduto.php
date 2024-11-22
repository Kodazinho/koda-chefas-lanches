<?php
    $produto = [];
    if(isset($_GET['edit'])){    
        // busca o produto
    $produto = $database->buscar($_GET['edit']);
        // transforma de objeto mysql para array
    $produto = $produto->fetch_assoc();
}