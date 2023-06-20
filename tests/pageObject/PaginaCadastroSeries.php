<?php

namespace Alura\E2E\Tests\PageObject;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;

class PaginaCadastroSeries {

    private $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
        $this->driver->get('http://localhost:8080/adicionar-serie');
    }

    public function preencheNome(string $nome): self
    {
        $this->driver->findElement(WebDriverBy::id('nome'))->sendKeys($nome);
        return $this;
    }

    public function selecionaGenero(string $valorGenero): self
    {
        $selectGenero = new WebDriverSelect($this->driver->findElement(WebDriverBy::id('genre')));
        $selectGenero->selectByValue($valorGenero);

        return $this;
    }

    public function comTemporadas(int $quantidade): self
    {
        $this->driver->findElement(WebDriverBy::id('qtd_temporadas'))->sendKeys($quantidade);

        return $this;
    }

    public function comEpisodios(int $quantidade): self
    {
        $this->driver->findElement(WebDriverBy::id('ep_por_temporada'))->sendKeys($quantidade);

        return $this;
    }

    public function enviaFormulario(): void
    {
        $this->driver
            ->findElement(WebDriverBy::cssSelector('button[type="submit"]'))
            ->click();
    }
}