<?php

use Alura\E2E\Tests\PageObject\PaginaCadastroSeries;
use Alura\E2E\Tests\PageObject\PaginaLogin;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;
use PHPUnit\Framework\TestCase;

class CadastroSeriesTest extends TestCase
{
    private static $driver;

    public static function setUpBeforeClass(): void
    {
        $host = 'http://localhost:4444';
        self::$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

        $email = 'pituco@gmail.com';
        $senha = '123';
        $paginaLogin = new PaginaLogin(self::$driver);
        $paginaLogin->efetuarLogin($email, $senha);
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->quit();
    }

    public function testCadastrarNovaSerieDeveRedirecionarParaLista()
    {

        // ACT
        $cadastroSeries = new PaginaCadastroSeries(self::$driver);
        $cadastroSeries->preencheNome('Série de Teste')
            ->selecionaGenero('acao')
            ->comTemporadas(2)
            ->comEpisodios(3)
            ->enviaFormulario();

        // ASSERT
        self::assertSame('http://localhost:8080/series', self::$driver->getCurrentURL());
        self::assertSame(
            'Série com suas respectivas temporadas e episódios adicionada.',
            trim(self::$driver->findElement(WebDriverBy::cssSelector('div.alert.alert-success'))->getText())

        );
    }
}