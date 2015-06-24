<?php

Class Pedido implements IPedido{
    
    private $pedidoItens = Array();
    
    public function getPedidosItens(){
        return $this->pedidoItens;
    }
    
    public function addItemPedido(IProduto $produto, $quantidade){
        $this->pedidoItens[] = Array($produto, $quantidade);
    }
}
