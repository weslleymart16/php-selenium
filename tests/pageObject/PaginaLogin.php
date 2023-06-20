<?php

namespace Alura\E2E\Tests\PageObject;

use Facebook\WebDriver\WebDriverBy;

class PaginaLogin {

    private  $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function efetuarLogin(string $email, string $senha)
    {
        $this->driver->get('http://localhost:8080/entrar');

        $this->driver
            ->findElement(WebDriverBy::id('email'))
            ->sendKeys($email);

        $this->driver
            ->findElement(WebDriverBy::id('password'))
            ->sendKeys($senha)
            ->submit();
    }

}