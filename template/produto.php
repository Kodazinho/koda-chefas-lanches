<?php

function produto($row){
    $nomeProduto = $row['nome'];
    $imagemBase64 = $row['imagem_base64'];
    $preco = $row['preco'];
    $id = str_replace(' ', '-', $row['nome']);

    $result = "<div id='" . $id . "' class='relative flex flex-col items-center justify-center bg-cover bg-center h-[20vh] w-[20vw] rounded-lg drop-shadow-md' style='background-image: url(\"data:image/jpeg;base64," . $imagemBase64 . "\");'>
        <div class='absolute bottom-0 bg-gradient-to-t from-black to-transparent w-full text-center p-3 rounded-b-lg'>
            <h2 class='text-white text-sm font-semibold'>" . $nomeProduto . "</h2>
            <p class='text-white text-xs'>" . $preco . " R$</p>
        </div>
        
        <div class='absolute top-2 right-2 flex gap-2'>
            <button type='button' class='h-10 w-10 bg-green-500 text-white p-2 rounded-full shadow-md hover:bg-green-600 transition-transform duration-200' onclick='add(\"" . strtolower($row['nome']) . "\")'>
                +
            </button>
            <button type='button' class='h-10 w-10 bg-red-500 text-white p-2 rounded-full shadow-md hover:bg-red-600 transition-transform duration-200' onclick='remove(\"" . strtolower($row['nome']) . "\")'>
                -
            </button>
            <div class=' flex items-center justify-center bg-white text-black rounded-full h-7 w-7'>
                <h1 id='q" . $id . "'>0</h1>
            </div>
        </div>
    </div>";

    return $result;
}
