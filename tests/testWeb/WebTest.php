<?php

Class WebTeste extends PHPUnit_Framework_TestCase {

    private $driver;
    private $url;

    protected function setUp() {

        $this->url = "http://localhost/phpunit/web/";
        
        $this->driver = RemoteWebDriver::create(
                        "http://localhost:4444/wd/hub", DesiredCapabilities::firefox()
        );

        $this->driver->manage()->window()->maximize();
    }

    /**
     * @test
     */
    public function acessarPaginaInicialEVerMensagemDeBoasVindas() {

        $this->driver->get($this->url);

        $this->driver->navigate()->to($this->url . "/listaritens.php");

        $this->driver->navigate()->back();
    }

    /**
     * @test
     */
    public function acessarElementosDoDom() {

        $this->driver->get($this->url);

        $this->assertEquals("Starter Template - Materialize", $this->driver->getTitle());
        $this->assertEquals("Qualister PHP Testing", $this->driver->findElement(WebDriverBy::id("logo-container"))->getText());
    }

    /**
     * @test
     */
    public function parseValidationInDomFindByTagTitle() {

        $this->driver->get($this->url);

        $footer = $this->driver->findElement(WebDriverBy::cssSelector(".footer-copyright > .container"))->getText();
        $tag = $this->driver->findElement(WebDriverBy::cssSelector("*[class*='no-pad-bot']"))->getTagName();
        
        $this->assertEquals("Made by Materialize", $footer);
        $this->assertEquals("div", $tag);
    }

    protected function tearDown() {
        $this->driver->quit();
    }

}
