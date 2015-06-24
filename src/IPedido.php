<?php

interface IPedido {

    public function getPedidosItens();

    public function addItemPedido(IProduto $produto, $quantidade);
}
