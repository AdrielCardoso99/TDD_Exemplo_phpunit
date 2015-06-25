<?php

Class WebTeste extends PHPUnit_Framework_TestCase {

    private $driver;

    protected function setUp() {

        $this->driver = RemoteWebDriver::create(
                        "http://localhost:4444/wd/hub", DesiredCapabilities::firefox()
        );

        $this->driver->manage()->window()->maximize();
    }

    /**
     * @test
     */
    public function acessarPaginaInicialEVerMensagemDeBoasVindas() {
        
        $this->driver->get("http://localhost/phpunit/web/");
        
        $this->driver->navigate()->to("http://localhost/phpunit/web/listaritens.php");

        $this->driver->navigate()->back();
    }

    protected function tearDown() {
        $this->driver->quit();
    }

}
