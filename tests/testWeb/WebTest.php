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

    /**
     * @test
     * @group ex5
     */
    public function acessarPaginaInicialClicarEmMeusPedidosMostrarAlerta() {

        $this->driver->get($this->url);

        $this->driver->findElement(WebDriverBy::id("meuspedidos"))->click();
        $this->driver->switchTo()->alert()->accept();

        $texto = $this->driver->switchTo()->alert()->getText();
        $this->driver->switchTo()->alert()->dismiss();
        $this->assertEquals("Faça login antes", $texto);
    }

    public function validarPaginaIcialValidarMensagemAlerta() {

        $this->driver->get($this->url);

        $this->driver->findElement(WebDriverBy::id("novopedido"))->click();
        $this->driver->findElement(WebDriverBy::id("id"))->sendKeys("TESTE");

        $combo = $this->driver->findElement(WebDriverBy::id("produto"));
        $combo = new WebDriverSelect($combo);
        $combo->selectByValue("Firefox");
        $this->driver->findElement(WebDriverBy::id("estoque"))->sendKeys(100);
        $this->driver->findElement(WebDriverBy::id("valor"))->sendKeys(19.90);

        $this->driver->findElement(WebDriverBy::cssSelector("label[for='quantidade5']"))->click();
        $this->driver->findElement(WebDriverBy::tagName("button"))->click();

        $mensagem = $this->driver->switchTo()->alert()->getText();
        $this->driver->switchTo()->alert()->dismiss();

        $this->assertEquals("Sucesso", $mensagem);
    }

    /**
     * @test
     */
    public function validaTempoDeMensagemVoceEPassienteEm7Segundos() {

        $this->driver->manage()->timeouts()->implicitlyWait(2);
        $this->driver->get($this->url);

        $mensagem = $this->driver->findElement(WebDriverBy::id("mensagem-magica"))->getText();

        $this->assertEquals("Voce e paciente!", $mensagem);
    }

    protected function tearDown() {
        $this->driver->quit();
    }

}
