<?php
require_once 'funcoes.php';
$cod_livro = isset($_GET['cod_livro']) ? intval($_GET['cod_livro']) : null;
if (empty($cod_livro)) {
    echo "Código do livro não informado.<br>";
    exit;
}

$PDO = conecta_bd();
$stmt = $PDO->prepare('SELECT cod_livro, titulo_livro, cod_isbn, autor_livro, nome_editora, qtd_paginas FROM livros WHERE cod_livro = :cod_livro');
$stmt->bindParam(':cod_livro', $cod_livro, PDO::PARAM_INT);

$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!is_array($resultado)) {
    echo "Livro não encontrado.<br>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de livros</title>
</head>
<body>
    <h2>Formulário de alteração</h2>
    <form action="altera.php" method="post">
        <label for="titulo_livro">Título:</label>
        <input type="text" id="titulo_livro" name="titulo_livro" value="<?=$resultado['titulo_livro']?>"><br><br>
        <label for="cod_isbn">ISBN:</label>
        <input type="text" id="cod_isbn" name="cod_isbn" value="<?=$resultado['cod_isbn']?>"><br><br>
        <label for="autor_livro">Autor:</label>
        <input type="text" id="autor_livro" name="autor_livro" value="<?=$resultado['autor_livro']?>"><br><br>
        <label for="nome_editora">Editora:</label>
        <input type="text" id="nome_editora" name="nome_editora" value="<?=$resultado['nome_editora']?>"><br><br>
        <label for="qtd_paginas">Páginas:</label>
        <input type="text" id="qtd_paginas" name="qtd_paginas" value="<?=$resultado['qtd_paginas']?>"><br><br>
        <input type="hidden" name="cod_livro" value="<?=$cod_livro?>">
        <input type="submit" value="Alterar">
    </form>
    
</body>
</html>