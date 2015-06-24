<?php

Class Produto implements IProduto {

    private $produtoId;
    private $produtoNome;
    private $produtoEstoque;
    private $produtoValor;

    public function __contruct($produtoId, $produtoNome, $produtoEstoque, $produtoValor) {
        $this->produtoId = $produtoId;
        $this->produtoNome = $produtoNome;
        $this->produtoEstoque = $produtoEstoque;
        $this->produtoValor = $produtoValor;
    }

    function getProdutoId() {
        return $this->produtoId;
    }

    function getProdutoNome() {
        return $this->produtoNome;
    }

    function getProdutoEstoque() {
        return $this->produtoEstoque;
    }

    function getProdutoValor() {
        return $this->produtoValor;
    }

    function setProdutoId($produtoId) {
        $this->produtoId = $produtoId;
    }

    function setProdutoNome($produtoNome) {
        $this->produtoNome = $produtoNome;
    }

    function setProdutoEstoque($produtoEstoque) {
        $this->produtoEstoque = $produtoEstoque;
    }

    function setProdutoValor($produtoValor) {
        $this->produtoValor = $produtoValor;
    }

}
