<?php
require_once 'funcoes.php';
$titulo_livro = isset($_POST['titulo_livro']) ? $_POST['titulo_livro'] : null;
$cod_isbn = isset($_POST['cod_isbn']) ? $_POST['cod_isbn'] : null;
$autor_livro = isset ($_POST['autor_livro']) ? $_POST['autor_livro'] : null;
$nome_editora = isset($_POST['nome_editora']) ? $_POST['nome_editora'] : null;
$qtd_paginas = isset($_POST['qtd_paginas']) ? intval($_POST['qtd_paginas']) : null;

if (empty($titulo_livro) || empty($cod_isbn) || empty($autor_livro) || empty($nome_editora) || empty($qtd_paginas)) {
    echo "Todos os campos são obrigatórios.<br>";
    exit;
}

$PDO = conecta_bd();
$sql = "INSERT INTO livros (titulo_livro, cod_isbn, autor_livro, nome_editora, qtd_paginas) VALUES (:titulo_livro, :cod_isbn, :autor_livro, :nome_editora, :qtd_paginas)";

$stmt = $PDO->prepare($sql);
$stmt->bindParam(':titulo_livro', $titulo_livro);
$stmt->bindParam(':cod_isbn', $cod_isbn);
$stmt->bindParam(':autor_livro', $autor_livro);
$stmt->bindParam(':nome_editora', $nome_editora);
$stmt->bindParam(':qtd_paginas', $qtd_paginas);

if ($stmt->execute()) {
    header('Location: form_inclui.php');
} else {
    echo "Erro ao incluir livro.<br>";
    print_r($stmt->errorInfo());
}