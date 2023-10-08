<?php

class Produto
{
    public function __construct(
        private ?int $id,
        private string $tipo,
        private string $nome,
        private string $descricao,
        private float $preco,
        private string $imagem = 'logo-serenatto.png',
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }

    public function getImagemDiretorio(): string
    {
        return 'img/' . $this->imagem;
    }


    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getPrecoFormatado(): float
    {
        if (is_string($this->preco)) {
            $this->preco = floatval($this->preco);
        }

        return number_format($this->preco, 2);
    }

    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }

    public function setImagem(string $imagem)
    {
        $this->imagem = $imagem;
    }

    public function setPreco(float $preco)
    {
        $this->preco = $preco;
    }
}