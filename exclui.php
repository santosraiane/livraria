<?php
require_once 'funcoes.php';
$cod_livro = isset($_GET['cod_livro']) ? intval($_GET['cod_livro']) : null;

if (empty($cod_livro)) {
    echo "Código do livro não informado<br>";
    exit;
}

$PDO = conecta_bd();
$sql = "DELETE FROM livros WHERE cod_livro = :cod_livro";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':cod_livro', $cod_livro, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: index.php');
} else {
    echo "Erro ao excluir livro.<br>";
    print_r($stmt->errorInfo());
}