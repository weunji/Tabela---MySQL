<?php
require_once 'pessoas.php';
require_once 'conexao.php';

$id_pessoa = $_GET['id_pessoa'];

try {
    $pessoa = new Pessoas($id_pessoa);
    $pessoa->deletar();


    setcookie("deletado", true);
    header("Location: index.php");
} catch (PDOEException $e){
    echo $sql. "<br>" . $e->getMessage();
}

?>