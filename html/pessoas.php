<?php


class Pessoas{
    public $id_pessoa;
    public $nome;
    public $idade;
    public $data_registro;

    public function __construct($id_pessoa = false){
        if($id_pessoa){
            $this->id_pessoa = $id_pessoa;
            $this->carregar();
        }
    }

    public function carregar(){
        $query = "SELECT nome, idade, data_registro FROM pessoas WHERE id_pessoa = :id_pessoa";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_pessoa', $this->id_pessoa);
        $stmt->execute();

        $lista = $stmt->fetch();
        $this->nome = $lista['nome'];
        $this->idade = $lista['idade'];
        $this->data_registro = $lista['data_registro'];

    }        

    public function inserir(){
        $query = "INSERT INTO pessoas (nome, idade) VALUES (:nome, :idade)";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':idade', $this->idade);
        $stmt->execute();
    }





    /*public static function listar(){
        $query = "SELECT *  pessoas";
        $conexao = Conexao::conectar();
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }*/

////////////------------------------------------

    public static function listar(){ // lista os registros da tabela
        $query = "SELECT * FROM pessoas";
        // selecione todas as colunas da tabela
        $conexao = Conexao::conectar();
        // cria conexao
        $resultado = $conexao->query($query);
        // executa a query e guarda o que foi retornado em uma variavel resultado
        $lista = $resultado->fetchAll();
        // transforma todos os valores obtidos na variavel resultado em um array associativo ("chave":"valor")
        return $lista;
        // devolve o array
    }




    public function atualizar(){
        $query = "UPDATE pessoas SET nome = :nome, idade = :idade WHERE id_pessoa = :id_pessoa";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":idade", $this->idade);
        $stmt->bindValue(":id_pessoa", $this->id_pessoa);
        $stmt->execute();
    }

    public function deletar(){
        $query = "DELETE FROM pessoas WHERE id_pessoa = :id_pessoa";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":id_pessoa", $this->id_pessoa);
        $stmt->execute();
    
    }


    public function listarPorNome($palavra){
        $palavra = '%' . $palavra . '%';
        $query = "SELECT * FROM pessoas WHERE nome LIKE :palavra";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":palavra", $palavra);
        $stmt->execute();
        $lista = $stmt->fetchAll();
        return $lista;
    }
}



?>