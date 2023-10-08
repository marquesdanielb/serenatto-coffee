<?php

class RepositorioProdutos
{
    public function __construct(
        private \PDO $pdo,
    ) {}

    public function buscar_todos()
    {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $query = $this->pdo->query($sql);
        $produtos = $query->fetchAll(PDO::FETCH_ASSOC);

        $todosProdutos = array_map(function ($produto) {
            return $this->formarObjeto($produto);
        }, $produtos);

        return $todosProdutos;
    }

    public function buscar_produtos_cafe(): array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $query = $this->pdo->query($sql);

        $produtosCafe = $query->fetchAll(PDO::FETCH_ASSOC);

        $dadosCafe = array_map(function ($cafe) {
            return $this->formarObjeto($cafe);
        }, $produtosCafe);

        return $dadosCafe;
    }

    public function buscar_produtos_almoco(): array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
        $query = $this->pdo->query($sql);

        $produtosAlmoco = $query->fetchAll(PDO::FETCH_ASSOC);

        $dadosAlmoco = array_map(function ($almoco){
            return $this->formarObjeto($almoco);
        }, $produtosAlmoco);

        return $dadosAlmoco;
    }

    public function buscar_produto(int $id): Produto
    {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $resultado = $this->pdo->prepare($sql);

        $resultado->bindValue(1, $id);
        $resultado->execute();

        $dados = $resultado->fetch(PDO::FETCH_ASSOC);
        
        return $this->formarObjeto($dados);
    }

    private function formarObjeto(array $produto)
    {
        return new Produto(
            $produto['id'],
            $produto['tipo'],
            $produto['nome'],
            $produto['descricao'],
            $produto['preco'],
            $produto['imagem'],
        );
    }

    public function remover_produto(int $id)
    {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
    }

    public function cadastrar_produto(Produto $produto)
    {
        $sql = "INSERT INTO produtos 
            (tipo, nome, descricao, preco, imagem)
        VALUES 
            (?, ?, ?, ?, ?)";
        
        $resultado = $this->pdo->prepare($sql);
        $resultado->bindValue(1, $produto->getTipo());
        $resultado->bindValue(2, $produto->getNome());
        $resultado->bindValue(3, $produto->getDescricao());
        $resultado->bindValue(4, $produto->getPreco());
        $resultado->bindValue(5, $produto->getImagem());
        
        $resultado->execute();
    }
    
    public function editar_produto(Produto $produto)
    {
        $sql = "UPDATE produtos 
                SET tipo = ?,
                    nome = ?,
                    descricao = ?,
                    preco = ?,
                    imagem = ?
                WHERE id = ?";
        $resultado = $this->pdo->prepare($sql);

        $resultado->bindValue(1, $produto->getTipo());
        $resultado->bindValue(2, $produto->getNome());
        $resultado->bindValue(3, $produto->getDescricao());
        $resultado->bindValue(4, $produto->getPreco());
        $resultado->bindValue(5, $produto->getImagem());
        $resultado->bindValue(6, $produto->getId());

        $resultado->execute();

    }
}