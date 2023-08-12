# TESTE - BACKEND

## Especificações do Projeto

- [PHP 8.1](https://www.php.net/releases/8.1/en.php)
- [Laravel 10](https://laravel.com/docs/10.x/releases)
- [L5](https://github.com/andersao/l5-repository)

## Dependencias:

- Docker e docker-compose
- Make

#### Coleçao do postman com exemplos no arquivo "Flip Saude.postman_collection" dentro da pasta "collection"

## Variaveis de ambiente
```bash
Renomear o arquivo .env.example para .env
```

## Instalação

### Instale o MAKE

O make foi utilizado para simplificar a instalação do projeto.

### Instale a aplicaçao

Execute o comando abaixo

```bash
make install
```

### URLs

- Projeto (http://localhost:8100/api)

## Outros Comandos

### Para executar os testes

Execute o comando abaixo

```bash
make test
```

### Para levantar os containers

Execute o comando abaixo

```bash
make up
```

### Para derrubar container

Execute o comando abaixo

```bash
make down
```

### Para executar migrate e seed

Execute o comando abaixo

```bash
make migrate
```

### Para limpar o cache

Execute o comando abaixo

```bash
make clear
```

### Para iniciar o bash e executar comandos especificos dentro da API

Execute o comando abaixo

```bash
make bash
```

### Para criar uma nova entidade na API

Execute o make bash e e depois o comando abaixo

```
php artisan make:entity NomeDaEntidade
```

Para mais informaçoes sobre CRUD e o Repositorio Acessar documentaçao do L5-Repository

#### outros comandos veja o makefile.





