<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
{

    private static $driver;

    public static function setUpBeforeClass(): void
    {
        $host = 'http://localhost:4444';
        self::$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
    }

    protected function setUp(): void
    { 
        self::$driver->get('http://localhost:8080/novo-usuario');
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->quit();
    }

    public function testQuandoRegistrarNovoUsuarioRedirecionarParaListaDeSeries()
    {
        // ACT
        $inputName = self::$driver->findElement(WebDriverBy::id('name'));
        $inputEmail = self::$driver->findElement(WebDriverBy::id('email'));
        $inputPassword = self::$driver->findElement(WebDriverBy::id('password'));
        $buttomSubmit = self::$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'));

        $inputName->sendKeys('Pituco Martins');
        $inputEmail->sendKeys(md5(time()) . '@gmail.com');
        $inputPassword->sendKeys('123');

        $buttomSubmit->submit();

        // ASSERT
        self::assertSame('http://localhost:8080/series', self::$driver->getCurrentURL());
        self::assertInstanceOf(
            RemoteWebElement::class,
            self::$driver->findElement(WebDriverBy::linkText('Sair'))
        );
    }
}
