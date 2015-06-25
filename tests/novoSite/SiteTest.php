<?php

Class SiteTest extends PHPUnit_Framework_TestCase {

    private $url;
    private $driver;

    public function setUp() {

        $this->url = "http://www.quickloja.planned.by";

        $this->driver = RemoteWebDriver::create(
                        "http://localhost:4444/wd/hub", DesiredCapabilities::firefox()
        );

        $this->driver->manage()->window()->maximize();
    }

    public function fazLoginNoWebServerComACredencialDefault() {

        $this->driver->get($this->url);

        $this->driver->findElement(WebDriverBy::id("usuariologin"))->sendKeys("teste");
        $this->driver->findElement(WebDriverBy::id("usuariosenha"))->sendKeys("123");

        $this->driver->findElement(WebDriverBy::tagName("button"))->click();

        $this->assertEquals("Administração QuickLoja", $this->driver->getTitle());

        
        
        $this->driver->get($this->url);

        $this->driver->findElement(WebDriverBy::linkText("Gerenciar módulos"))->click();
    }
    
    public function login($user, $pass){
        $this->driver->get($this->url);

        $this->driver->findElement(WebDriverBy::id("usuariologin"))->sendKeys("teste");
        $this->driver->findElement(WebDriverBy::id("usuariosenha"))->sendKeys("123");

        $this->driver->findElement(WebDriverBy::tagName("button"))->click();

        $this->assertEquals("Administração QuickLoja", $this->driver->getTitle());
        
        return $this->driver;
    }
    
    public function acessarAdministracao($driver)
    {
        $this->driver->findElement(WebDriverBy::linkText("Gerenciar módulos"))->click();
        
        return $this->driver;
    }

    /**
     * 
     * @test
     */
    public function logarEClicarNoAdministracao() {
        
        $this->acessarAdministracao($this->login("teste", "123"));
    }

}
