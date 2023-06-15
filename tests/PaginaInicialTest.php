<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;

class PaginaInicialTest extends TestCase
{
    public function testPaginaInicialNaoLogadaDeveSerListagemDeSeries()
    {
        // Arrange
        $host = 'http://localhost:4444';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

        // Act
        $driver->navigate()->to('http://localhost:8080');

        // Assert
        $h1Locator = WebDriverBy::tagName('h1');
        $textH1 = $driver->findElement($h1Locator)->getText();

        // $buttonAdicionar = $driver->findElement(WebDriverBy::linkText('Adicionar'))->getText();

        self::assertSame('Séries', $textH1);
        // self::assertSame('Adicionar', $buttonAdicionar);
    }
}
