<?php


$con = new mysqli('localhost', 'root', '', 'lanchonete');

class Database{
    private $conexao;
    public function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function inserirproduto($nome, $image, $preco){
        $sql = "INSERT INTO produtos (nome, imagem_base64, preco) VALUES ('$nome', '$image', $preco)";
        if(!$this->conexao->query($sql)){
            echo $this->conexao->error;
        }
    }

    public function produtos(){
        $sql = "SELECT * FROM produtos";
        $produtos = $this->conexao->query($sql);
        return $produtos;
    }

}

$database = new Database($con);