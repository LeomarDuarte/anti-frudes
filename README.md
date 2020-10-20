# API anti-fraudes

Sistema anti-fraudes que adiciona CPFs em uma lista de restrição

### Requirements:
- [Lumen Framework - 8.0.1](https://lumen.laravel.com/docs/8.x)
- [PHP - Versão 7.4.^](https://www.php.net/downloads.php)

### API Documentation

- [URL](https://documenter.getpostman.com/view/2613074/TVReeBHS)

### Setup Project.

- Fazer o clone do projeto
    
    `git clone https://github.com/LeomarDuarte/anti-fraudes.git`

- Acessar o diretório anti-fraudes
    
    `cd anti-fraudes
    `
- Instalar as dependências do projeto

    `composer install`

- Criar e editar o arquivo .env

    `cp .env.example .env`

- Criar a chave de criptografia

    `php artisan key:generate`

### Up Application

- Localhost
    
    `php -S localhost:PORTA -t public`

### Tests

- Integração

    `vendor/bin/phpunit tests --feature`

- Unitários

    `vendor/bin/phpunit tests --unit`
    
- Code coverage

    - Após a execução dos testes, será criado o diretório `tests/reports` dentro do path `tests`.
    - Copiar o path do arquivo `tests/reports/coverage/index.html` e coloar em seu navegador para ver a análise de cobertura.