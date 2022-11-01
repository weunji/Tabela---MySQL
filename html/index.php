<?php 
require_once 'conexao.php';
require_once 'pessoas.php';



//--------------------------------------------------------
try{
    $conn = Conexao::conectar();
    $sql = "CREATE DATABASE IF NOT EXISTS myTabela";
    $conn->exec($sql);
    /*echo ""; Tabela criada com sucesso <br> */
} catch (PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;

//-------------------------------------------------------


try {
    $conn = Conexao::conectar();
    $sql = "CREATE TABLE IF NOT EXISTS pessoas (
        id_pessoa int(6) AUTO_INCREMENT PRIMARY KEY,
        nome varchar(255),
        idade int(3),
        data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $conn->exec($sql);
    /* echo ""; Tabela criada com sucesso <br> */
} catch(PDOException $e){
    echo $sql. "<br>" . $e->getMessage();
};
$conn = null;

//-----------------------------------------------------------
if(isset($_GET['busca'])){
    $palavra = $_GET['busca'];
    try {
        $pessoa = new Pessoas();
        $lista = $pessoa->listarPorNome($palavra);
    }catch (Exception $e){
        echo $e->getMessage();
    }
} else {
    try {
        $pessoa = new Pessoas();
        $lista = $pessoa->listar();

    } catch (Exception $e){
        echo $e->getMessage();
    }
}

/*  */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="toast.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <div id="exibe"></div>
    <div class="flex-container space-between" id="topo">
        <div>
            <button id="btn_criar"><a href="criar_pessoa.php"><span class="material-symbols-sharp">add</span></a></button>
        </div>
        <div id="campo_pesquisa">
            <form action="index.php" class="flex-container">
                <input type="search" name="busca" id="busca">
                <button type="submit" id="lupa">
                    <span class="material-symbols-sharp">search</span>
                </button>
            </form>
        </div>
    </div>
    <div class="flex-container">
        <table style="border: 1px solid black; padding: 20px;">
            <tr>
                <th>id</th>
                <th>nome</th>
                <th>idade</th>
                <th>registro</th>
            </tr>
            <?php foreach($lista as $item): ?>
                <tr>
                    <td><?= $item['id_pessoa'] ?></td>
                    <td><?= $item['nome'] ?></td>
                    <td><?= $item['idade'] ?></td>
                    <td><?= $item['data_registro'] ?></td>
                    <td><a href="editar.php?id_pessoa=<?= $item['id_pessoa']?>"><span class="material-symbols-sharp" id="btn-edit">edit</span></a></td>
                    <td><a href="delete.php?id_pessoa=<?= $item['id_pessoa']?>"><span class="material-symbols-sharp" id="btn-delete">delete_forever</span></a></td>
                </tr>
            <?php endforeach ?>
            
        </table>
    </div>
    <script src="script.js"></script>
</body>
</html>

