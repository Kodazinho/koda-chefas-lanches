<?php

ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');

if (isset($_POST['nome']) && isset($_FILES['foto']) && isset($_POST['preco'])) {

    // pega caminho temporario da imagem na ram
    $caminhoTemporario = $_FILES['foto']['tmp_name'];

    // pega o conteudo binário da imagem que está na ram
    $conteudoBinario = file_get_contents($caminhoTemporario);

    // transforma esse imagem em binário em base64, que é imagem em String.
    $base64 = base64_encode($conteudoBinario);

    // pega o tipo da imagem, (jpeg, png, jpg ... )
    $tipoMime = mime_content_type($caminhoTemporario);

    // coloca os prefixos html para a imagem ser carregada em base64 via html
    $imagemBase64 = "data:$tipoMime;base64," . $base64;

    // tira os prefixos que o SQL não aceita dentro de uma String
    $imagemBase64 = preg_replace('/^data:image\/\w+;base64,/', '', $imagemBase64);

    // manda a imagem para o database usando o método da classe database
    $database->inserirproduto($_POST['nome'], $imagemBase64, $_POST['preco']);

    // manda o usuário para a pagina de cadastro do pedido
    header('Location: index.php');
}
?>
