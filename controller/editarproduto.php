<?php


if(isset($_GET['del'])){
    $database->deletar($_GET['del']);
    header('Location: editarprodutos.php');
}

if (isset($_POST['nome']) && isset($_POST['preco'])) {
    // vê se tem foto enviada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        // se tiver, manda as novas configurações e a foto
        $database->editarProduto($_GET['edit'], $_POST['nome'], $_FILES['foto'], $_POST['preco']);
    } else {
        // se não tiver, manda as configurações sem foto
        $database->editarProduto($_GET['edit'], $_POST['nome'], null, $_POST['preco']);
    }
    header('Location: editarprodutos.php');
}
