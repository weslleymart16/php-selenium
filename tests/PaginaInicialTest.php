<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
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
        self::assertStringContainsString('Weslley', $driver->getPageSource());
    }
}
