<?php


$con = new mysqli('localhost', 'root', '', 'lanchonete');

class Database
{
    private $conexao;
    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function inserirproduto($nome, $image, $preco)
    {
        $sql = "INSERT INTO produtos (nome, imagem_base64, preco) VALUES ('$nome', '$image', $preco)";
        if (!$this->conexao->query($sql)) {
            echo $this->conexao->error;
        }
    }

    public function pedido($nome, $preco, $pedidos)
    {
        // Pegar a data atual
        $data = date('Y-m-d H:i:s');

        // preparar o SQL
        $sql = "INSERT INTO pedidos (cliente_nome, data_pedido, total) VALUES (?, ?, ?)";
        // Prepara para a string para receber os dados e evitar SQLInjection
        $stmt = $this->conexao->prepare($sql);

        // Insere os dados na string
        $stmt->bind_param('ssd', $nome, $data, $preco);

        //Executa o SQL.
        $stmt->execute();
        // Pega o id do pedido inserido
        $pedidoId = $this->conexao->insert_id;

        // Começa processo de buscar os produtos de cada pedido
        foreach ($pedidos as $pedido) {
            $produtoId = $pedido['id'];
            $quantidade = $pedido['quantidade'];

            // SQL para buscar o pedido master, onde tem os ids dos produtos
            $sqlProduto = "INSERT INTO pedido_produto (pedido_id, produto_id, quantidade) VALUES (?, ?, ?)";
            // Prepara string para receber os dados
            $stmtProduto = $this->conexao->prepare($sqlProduto);

            // Insere os dados
            $stmtProduto->bind_param('iii', $pedidoId, $produtoId, $quantidade);

            //Executa o sql
            if (!$stmtProduto->execute()) {
                error_log("Erro ao inserir o produto no pedido: " . $stmtProduto->error);
            }
        }
    }





    public function produtos()
    {
        $sql = "SELECT * FROM produtos";
        $produtos = $this->conexao->query($sql);
        return $produtos;
    }

    public function pedidos()
    {
        // SQL para pegar todos pedidos
        $sql = "SELECT * FROM pedidos";

        // Todos os pedidos vão para esta variavel
        $pedidosResult = $this->conexao->query($sql);

        $pedidosArray = [];  // Array para armazenar os pedidos

        // Juntar os produtos com os pedidos
        foreach ($pedidosResult as $pedido) {
            $id = $pedido['id'];

            // SQL Para pegar os produtos do pedido
            $sqlProdutos = "SELECT * FROM pedido_produto WHERE pedido_id = " . $id;
            $produtosResult = $this->conexao->query($sqlProdutos);

            $produtosArray = []; // Array para armazenar os produtos do pedido

            // Coloca os pedidos no array produtosArray
            foreach ($produtosResult as $produto) {
                $sqlProduto = "SELECT * FROM produtos WHERE id=" . $produto['produto_id']; // SQL para pegar produto
                $produtoData = $this->conexao->query($sqlProduto); // pega o item pedido
                $produtodata = $produtoData->fetch_assoc(); //Transforma em array
                $produto['nome'] = $produtodata['nome']; // Inclui o nome do produto ao array de produto
                $produtosArray[] = $produto;  // Adiciona cada produto ao array
            }

            // Adiciona os produtos ao pedido
            $pedido['produtos'] = $produtosArray;

            // Adiciona o pedido completo ao array de pedidos
            $pedidosArray[] = $pedido;
        }

        return $pedidosArray;  // Retorna o array com todos os pedidos
    }
}

$database = new Database($con);
