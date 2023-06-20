<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;

class PaginaInicialTest extends TestCase
{
    private static $driver;

    public static function setUpBeforeClass(): void
    {
        $host = 'http://localhost:4444';
        self::$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->quit();
    }
    
    public function testPaginaInicialNaoLogadaDeveSerListagemDeSeries()
    {
        // Act
        self::$driver->navigate()->to('http://localhost:8080');

        // Assert
        $h1Locator = WebDriverBy::tagName('h1');
        $textH1 = self::$driver->findElement($h1Locator)->getText();

        // $buttonAdicionar = self::$driver->findElement(WebDriverBy::linkText('Adicionar'))->getText();

        self::assertSame('Séries', $textH1);
        // self::assertSame('Adicionar', $buttonAdicionar);
    }
}
