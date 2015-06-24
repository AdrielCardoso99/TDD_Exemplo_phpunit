<?php

Class APITest extends PHPUnit_Framework_TestCase {

    private $mContex;
    private $param;
    private $path;

    public function setUp() {

        $this->path = ["base_uri" => "http://localhost/phpunit/api/"];
        $this->param = ['auth' => ['phptesting', '123']];

        $this->mContex = new GuzzleHttp\Client($this->path);
    }

    public function testeAcessaApiComParametrosEAguardandoCodigo200() {

        $obj = Array(
            'auth' => $this->param['auth'],
            'query' => Array(
                'nome' => "Adriel",
        ));

        $resposta = $this->mContex->get("pedido/1", $obj);
//        $resposta = $this->mContex->get("pedido?" . http_build_query($queryString), $this->param);
//        $resposta = $this->mContex->get("pedido?" . $id . "/nome=Adriel", $this->param);

        $body = json_decode($resposta->getBody(), true);

        $this->assertEquals(200, $resposta->getStatusCode());
        $this->assertEquals("application/json", $resposta->getHeader("content-type")[0]);
        echo $body['message'];

    }

    public function testeAcessarRootEntaoReceber200SucessoEcodigo() {

        $respota = $this->mContex->get("", $this->param);

        $this->assertEquals(200, $respota->getStatusCode());
        $this->assertEquals("application/json", $respota->getHeader("content-type")[0]);

        $body = json_decode($respota->getBody(), true);

        $this->assertEquals("successo", $body['status']);
        $this->assertEquals("Bem vindos a API Qualister", $body['message']);
        $this->assertEquals("gnitsetphp", $body['data']['codigo']);
    }

    public function testeAcessaItensDoPedidoEReceber200SucessoEData() {

        $respota = $this->mContex->get("pedido", $this->param);

        $this->assertEquals(200, $respota->getStatusCode());
        $this->assertEquals("application/json", $respota->getHeader("content-type")[0]);

        $body = json_decode($respota->getBody(), true);

        $this->assertEquals("successo", $body['status']);
        $this->assertEquals("a lista esta vazia", $body['message']);
        $this->assertCount(0, $body['data']);
    }

    public function testeAdicionarItemAoPedidoEVoltarSucesso(){
        
        $obj = Array(
            'auth' => $this->param['auth'],
            'pedido' => Array(
                'produtoId' => 1,
                'produtoNome' => "Carro",
                'produtoEstoque' => 2,
                'produtoValor' => 99,
                'quantidade' => 2,
            )
        );
        
        $resposta = $this->mContex->post("pedido", $obj);
        
        $body = $resposta->getBody();
       
        $this->assertEquals(200, $resposta->getStatusCode());
        $this->assertEquals("application/json", $resposta->getHeader("content-type")[0]);
        echo $body['message'];
    }
}
