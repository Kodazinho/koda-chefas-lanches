<?php
    $produto = [];
    if(isset($_GET['edit'])){    
    $produto = $database->buscar($_GET['edit']);
}