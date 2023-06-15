<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase {

     public function testQuandoRegistrarNovoUsuarioRedirecionarParaListaDeSeries() {

        // ARRANGE
        $host = 'http://localhost:4444';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $driver->get('http://localhost:8080/novo-usuario');

        // ACT
        $inputName = $driver->findElement(WebDriverBy::id('name'));
        $inputEmail = $driver->findElement(WebDriverBy::id('email'));
        $inputPassword = $driver->findElement(WebDriverBy::id('password'));
        $buttomSubmit = $driver->findElement(WebDriverBy::cssSelector('button[type=submit]'));

        $inputName->sendKeys('Pituco Martins');
        $inputEmail->sendKeys('pituco@gmail.com');
        $inputPassword->sendKeys('123');

        $buttomSubmit->submit();

        // ASSERT
        self::assertSame('http://localhost:8080/series', $driver->getCurrentURL());
        self::assertInstanceOf(
            RemoteWebElement::class, 
            $driver->findElement(WebDriverBy::linkText('Sair'))
        );

     }

}