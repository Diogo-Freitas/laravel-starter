<h3 align="center">
    <p align="center">
      <b>LARAVEL STARTER</b> 
    </p>
</h3>

<p align="center">
  <a href="https://github.com/Diogo-Freitas" target="_blank">
    <img alt="Made by Diogo-Freitas" src="https://img.shields.io/badge/By-Diogo--Freitas-green">
    <img alt="GitHub Last Commit" src="https://img.shields.io/github/last-commit/Diogo-Freitas/laravel-starter" />
    <img alt="Repo Size" src="https://img.shields.io/github/repo-size/Diogo-Freitas/laravel-starter" />
  </a>
</p>

<div align="center">
    <p>
        <a href="#sobre">Sobre</a> |
        <a href="#tecnologias-utilizadas">Tecnologias Utilizadas</a> |
        <a href="#plugins">Plugins Utilizados</a> |
        <a href="#screenshots">Screenshots</a> |
        <a href="#como-utilizar">Como Utilizar</a>
    </p>
</div>


<div id="sobre"></div>

## 🔖 Sobre

<p>O Laravel Starter serve como ponto de partida para novos projetos, com suporte a autenticação de dois fatores, verificação de e-mail e gerenciamento de usuários.</p>


<div id="screenshots"></div>

## 📷 Screenshots
<h1>
    <img width="270" alt="Dashboard" src="https://user-images.githubusercontent.com/65552838/149450317-010411e7-d42c-43fd-8876-92e75e55cbf5.png">
    <img width="270" alt="User" src="https://user-images.githubusercontent.com/65552838/149450476-ba686459-e91a-46f3-aa64-72276e90c561.png">
    <img width="270" alt="Profile" src="https://user-images.githubusercontent.com/65552838/149450486-c8725f69-7391-48ca-b277-58aa7313ba76.png">
</h1>

<div id="tecnologias-utilizadas"></div>


## 🚀 Tecnologias Utilizadas

- [PHP 8.1](https://php.net/)
- [Laravel 8.x](https://laravel.com/)

<div id="plugins"</div>

## 🧩 Plugins Utilizados

 - [Laravel UI](https://github.com/laravel/ui)
 - [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
 - [Intervention Image](https://github.com/Intervention/image)

<a id="como-utilizar"></a>

## 💻 Como Utilizar

1. Faça um clone :

```sh
  # Clonar o repositório
  $ git clone https://github.com/Diogo-Freitas/laravel-starter.git

  # Entrar no diretório
  $ cd laravel-starter
```

2. Instalando a Aplicação:

```sh
  # Instale as dependências
  $ composer install
  
  $ npm install && npm run dev

  # Crie um arquivo .env
  $ copy .env.example .env

  # Crie uma nova chave
  $ php artisan key:generate

  # Configure os parâmetros do servidor no arquivo .env

  # Execute as migrações
  $ php artisan migrate --seed

  # Executa a apliação
  $ php artisan serve
```

3. Login de acesso:

    **E-mail**: admin@email.com</br>
    **Senha**: password