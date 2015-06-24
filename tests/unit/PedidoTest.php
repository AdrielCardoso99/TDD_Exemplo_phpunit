<?php

class PedidoTest extends PHPUnit_Framework_TestCase {

    private $pedido;

    protected function setUp() {
        $this->pedido = new Pedido();
    }

    /**
     * @test
     * @covers PedidoTest::adicionar2ProdutosSalvarPedidoEReceberMensagemDeSucesso
     * @covers Produto
     * @covers PedidoServicos
     * @covers Pedido::addItemPedido
     * @covers PedidoServicos::salvar
     * @dataProvider dataAdicionar2ProdutosSalvarPedidoEReceberMensagemDeSucesso
     */
    public function adicionar2ProdutosSalvarPedidoEReceberMensagemDeSucesso(
    $id1, $nome1, $est1, $val1, $qtd1, $status) {

//        $produto = new Produto($id1, $nome1, $est1, $val1);
//        $pedidoServico = new PedidoServicos();
        // exemplo de MOCK

        $produto = $this->getMockBuilder("IProduto")
                ->setConstructorArgs(Array($id1, $nome1, $est1, $val1))
                ->getMock();

        $pedidoServico = $this->getMockBuilder("IPedidoServicos")
                ->setMethods(Array("salvar"))
                ->getMock();

        $pedidoServico->expects($this->once())
                ->method("salvar")
                ->with($this->isInstanceOf("IPedido"))
                ->willReturn("Sucesso");

        $this->pedido->addItemPedido($produto, $qtd1);
        $this->assertSame($status, $pedidoServico->salvar($this->pedido));
    }

    public function dataAdicionar2ProdutosSalvarPedidoEReceberMensagemDeSucesso() {

//        return Array(
//            Array(1, "PS", 5, 9.90, 2, "Sucesso"),
//            Array(2, "PS2", 5, 9.90, 2, "Sucesso"),
//            Array(3, "PS3", 5, 9.90, 2, "Sucesso"),
//        );

        return array_map("str_getcsv", file("teste.csv"));
    }

    /**
     * @test
     * @covers PedidoTest::ListaDePedidosDeveConter0Itens
     * @covers Pedido
     * @covers Pedido::getPedidosItens
     */
    public function listaDePedidosDeveConter0Itens() {

        // arrange
        $pedido = new Pedido();

        //Act
        $pedidoItens = $pedido->getPedidosItens();

        //Assert
        $this->assertCount(0, $pedidoItens);
    }

}
