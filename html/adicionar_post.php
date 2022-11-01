<?php

require_once 'pessoas.php';
require_once 'conexao.php';

try {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];

    $pessoa = new Pessoas();

    $pessoa->nome = $nome;
    $pessoa->idade = $idade;

    $pessoa->inserir();

    setcookie("adicionado", true);
    header("Location: index.php");


} catch (PDOException $e){
    echo $sql. "<br>" . $e->getMessage();
}




?>