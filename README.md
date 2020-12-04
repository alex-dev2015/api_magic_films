# API Rede Magic Films
## 📝 Índice

- [Sobre](#about)
- [Começando](#getting_started)
- [Uso](#usage)
- [Ferramentas usadas](#built_using)
- [Autor](#authors)


## 🧐 Sobre <a name = "about"></a>

Api Rest para cadastro de Diretores, Filmes, Classificação de Filmes e Atores.

## 🏁 Começando <a name = "getting_started"></a>

Essas instruções fornecerão uma cópia do projeto instalado e funcionando em sua máquina local para fins de desenvolvimento e teste.

### Pré requisitos

```
   php ^7.2
   composer
   laravel
   Mysql

```
Fazer o clone do projeto e entrar na pasta api_magic_films


```
   git clone https://github.com/alex-dev2015/api_magic_films.git
   cd api_magic_films
```

Executar o composer para a instalação das dependências do projeto

```
   composer install
```

Entrar no gerenciador de banco de dados mysql e criar uma base de dados
```
   > mysql -u db_user -p
   > CREATE DATABASE `magicflix` /*!40100 COLLATE 'utf8mb4_unicode_ci' */
```

Renomear o arquivo .env.example para .env e alterar as variáveis de ambiente 
relacionadas a conexão com o banco de dados

```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=magicflix
   DB_USERNAME=usuario_do_banco
   DB_PASSWORD=senha_do_banco  
```

Gerar a chave da aplicação

```
   php artisan key:generate
```

Rodar as migrations para a criação das tabelas.

```
   php artisan migrate   
```

Startar o servidor

```
   php artisan serve   
```


## 🎈 Uso <a name="usage"></a>


## Métodos
Requisições para a API devem seguir os padrões:
| Método | Descrição |
|---|---|
| `GET` | Retorna informações de um ou mais registros. |
| `POST` | Utilizado para criar um novo registro. |

# Group Recursos


# Diretores [api/directors]

### Novo(create) [POST]
+ Attibutes (Multipart)
  
   + name : Nome do diretor (string) - limite 255 caracteres
    
   
 + Response 201 (application/json)
 
  + Body
    ```json
    {
      "message": "Diretor cadastrado com sucesso!"
    }
    ```
   
### Listar Diretores(Read) [GET /api/directors]


+ Response 200 (application/json)
  Todos os Diretores
  
  + Body
    ```json
    [
      {
          "id": 1,
          "name": "John Ford",
          "created_at": "2020-12-03T23:01:21.000000Z",
          "updated_at": "2020-12-03T23:01:21.000000Z"
        },
        {
          "id": 2,
          "name": "Steven Spielberg",
          "created_at": "2020-12-04T00:03:53.000000Z",
          "updated_at": "2020-12-04T00:03:53.000000Z"
        }
    ]
    ```  
+ Response 206 (application/json)
 Quando o registro não foi encontrado.

    + Body
    ```json
      {
        "message" => "Não há registros!"
      }
    ```
    
# Classificação [api/classifications]

### Novo(create) [POST]
+ Attibutes (Multipart)
  
   + name : Nome da classificação (string, unique) - limite 100 caracteres
    
 + Response 201 (application/json)
 
  + Body
  ```json
    {
      "message": "Classificação cadastrada com sucesso!"
    }
  ```
  
+ Response 500 (application/json)
  Erro de chave duplicada
  
  + Body
    ```json
    {
        "errorInfo": [
            "23000",
            1062,
            "Duplicate entry 'Terror' for key 'classifications_name_unique'"
        ]
    }
    ```
   
### Listar Classificação(Read) [GET /api/classifications]


+ Response 200 (application/json)
  Todas as Classificações de Filmes
  
  + Body
    ```json
      [
          {
              "id": 1,
              "name": "Comedia",
              "created_at": "2020-12-03T23:02:10.000000Z",
              "updated_at": "2020-12-03T23:02:10.000000Z"
          },
          {
              "id": 2,
              "name": "Ação",
              "created_at": "2020-12-03T23:02:18.000000Z",
              "updated_at": "2020-12-03T23:02:18.000000Z"
          }
      ]
    ```  
+ Response 206 (application/json)
 Quando o registro não for encontrado.

    + Body
    ```json
      {
        "message" => "Não há registros!"
      }
    ```

# Atores [api/actors]

### Novo(create) [POST]
+ Attibutes (Multipart)
  
   + name : Nome do ator (string) - limite 255 caracteres
    
   
 + Response 201 (application/json)
 
  + Body
    ```json
    {
      "message": "Ator cadastrado com sucesso!"
    }
    ```
   
### Listar Atores(Read) [GET /api/actors]


+ Response 200 (application/json)
  Todos os Atores
  
  + Body
    ```json
    [
        {
            "id": 1,
            "name": "John Travolta",
            "created_at": "2020-12-03T23:02:42.000000Z",
            "updated_at": "2020-12-03T23:02:42.000000Z"
        },
        {
            "id": 2,
            "name": "Will Smith",
            "created_at": "2020-12-03T23:02:50.000000Z",
            "updated_at": "2020-12-03T23:02:50.000000Z"
        }
    ]
    ```  
+ Response 206 (application/json)
 Quando o registro não for encontrado.

    + Body
    ```json
      {
        "message" => "Não há registros!"
      }
    ```


# Filmes [api/films]

### Novo(create) [POST]
+ Attibutes (Multipart)
  
   + name : Nome do filme (string, unique) - limite 255 caracteres
   + classification_id : Id da classificação (required, number, `1`)
   + director_id : Id do diretor (required, number, `1`)
   + actors : Id's dos atores (integer, require, `1,2,3`)
    
 + Response 201 (application/json)
 
  + Body
  ```json
    {
      "message": "Filme cadastrado com sucesso!"
    }
  ```
  
+ Response 500 (application/json)
  Erro de chave duplicada
  
  + Body
  ```json
    {
        "errorInfo": [
            "23000",
            1062,
            "Duplicate entry 'Ultimato Born' for key 'films_name_unique'"
        ]
    }
  ```
   
### Listar Filmes(Read) [GET /api/films]


+ Response 200 (application/json)
  Todos os filmes
  
  + Body
  ```json
     [
       {
          "id": 1,
          "name": "Ultimato Born",
          "classification_id": 2,
          "director_id": 1,
          "created_at": "2020-12-03T23:07:57.000000Z",
          "updated_at": "2020-12-03T23:07:57.000000Z"
       },
       {
          "id": 3,
          "name": "As aventuras de tim tim",
          "classification_id": 3,
          "director_id": 2,
          "created_at": "2020-12-04T00:45:50.000000Z",
          "updated_at": "2020-12-04T00:45:50.000000Z"
       }
     ]
  ```  
+ Response 206 (application/json)
 Quando o registro não for encontrado.

    + Body
    ```json
      {
        "message" => "Não há registros!"
      }
    ```

### Listar Filmes por Diretor(Read) [GET api/filmsForDirector/{id}]

+ Parameters
    + id (required, number, `1`) ... Código do Diretor
    
+ Response 200 (application/json)
  Todos os filmes por diretor e classificação
  
    + Body
    ```json
      {
          "Diretor": "John Ford",
          "Classificação": {
              "Ação": [
                  "Ultimato Born"
              ],
              "Romance": [
                  "Rio Grande",
                  "Os Aventureiros do Pacífico"
              ]
          }
      }
    ```

+ Response 206 (application/json)
 Quando o registro não for encontrado.

    + Body
    ```json
      {
        "message" => "Não há registros!"
      }
    ```
      
### Listar Atores por Filme(Read) [GET api/filmByActors/{id}]

+ Parameters
    + id (required, number, `1`) ... Código do Filme
    
+ Response 200 (application/json)
  Todos os atores de um determinado filme
  
  + Body
  ```json
     {
       "Filme": "Ultimato Born",
       "Atores": [
                   "John Travolta",
                   "Will Smith",
                   "Adam Sandle",
                   "Bred Pitty"
       ]
     }
  ```  

+ Response 206 (application/json)
 Quando o registro não for encontrado.

  + Body
  ```json
    {
       "message" => "Não há registros!"
    }
  ```
    

## ⛏️ Ferramentas usadas <a name = "built_using"></a>

- [Laravel](https://laravel.com/) - Framework PHP
- [PhpStorm](https://www.jetbrains.com/phpstorm/promo/?gclid=Cj0KCQiAtqL-BRC0ARIsAF4K3WFXUVNODzh3Kv31HLUJMvIur5-0RNAj-T4XXfSf-AG495J40m-5-pUaAs1HEALw_wcB) - Ide de Desenvolvimento

## ✍️ Autor <a name = "authors"></a>

- [Página Pessoal](https://alexsousa.eti.br) - Alex Sousa
