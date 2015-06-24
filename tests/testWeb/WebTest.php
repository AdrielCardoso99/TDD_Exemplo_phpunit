<?php

Class WebTeste extends PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function acessarPaginaInicialEVerMensagemDeBoasVindas() {

        $driver = RemoteWebDriver::create(
                        "http://localhost:4444/wd/hub", DesiredCapabilities::firefox()
        );

        $driver->manage()->window()->maximize();
        $driver->get("http://localhost/phpunit/web/");
        $driver->quit();
    }

}
