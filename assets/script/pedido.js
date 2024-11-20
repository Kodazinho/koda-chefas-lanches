const pedido = document.getElementById('pedido');

// função para adicionar produtos 
function add(id) {
    produtos[id].quantidade++;
    document.getElementById('q' + id).innerText = produtos[id].quantidade;
}

// função para tirar produtos

function remove(id) {
    if (produtos[id].quantidade > 0) {
        produtos[id].quantidade--;
    };
    document.getElementById('q' + id).innerText = produtos[id].quantidade;
}


// leitor de eventos, para processar o envio do formulario
pedido.addEventListener('submit', (event) => {

    // não deixa o form ser enviado
    event.preventDefault();
    var preco = 0;

    //calcula o preço de tudo
    produtos.forEach(produto => {
        preco += produto.preco * produto.quantidade;
    });

    // verifica se não esta tentando mandar um pedido sem produtos
    if (preco == 0) {
        document.getElementById('alerta').innerText = 'Registro do Pedido - Nenhum item selecionado.';
        document.getElementById('alerta').classList.add('text-red-600')
    } else {
        // Pega o formulario e cria uma nova data sobre ele.
        const formData = new FormData(pedido); 
        const nome = document.getElementById('nome').value
        const pedidos = [];

        // Pegar os produtos e suas quantidades passando para variavel pedido.
        produtos.forEach(produto => {
            const quantidade = produto.quantidade; 
            const id = produto.id; 
            if (quantidade > 0) { 
                pedidos.push({ id: id, quantidade: quantidade });
            }
        });

        // Adiciona os dados ao FormData
        formData.append('preco', preco); // Adicionando o preço ao FormData
        formData.append('pedidos', JSON.stringify(pedidos)); // Adicionando os pedidos em formato JSON ao FormData
        formData.append('nome', nome); // Adicionando o nome ao FormData

        console.log(pedidos)

        // Envia os dados via POST
        try{
            fetch('/', {
                method: 'POST',
                body: formData,
            })
        } catch(e){
            // trata qualquer erro que der ao enviar
            console.log(e)
        }

        window.location.href = '/pedidos.php'

    }
})
