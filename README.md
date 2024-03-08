<p align="center" dir="auto">
    <a target="_blank" rel="noopener noreferrer nofollow" href="https://camo.githubusercontent.com/cf25d81ab5acf028eda0aa2d361aca96198ef9d789a12a7e9b9931c8c799e297/68747470733a2f2f61646f6f7265692e73332e75732d656173742d322e616d617a6f6e6177732e636f6d2f696d616765732f6c6f6a655f74657374655f6c6f676f61646f6f7265695f313636323437363636332e706e67"><img src="https://camo.githubusercontent.com/cf25d81ab5acf028eda0aa2d361aca96198ef9d789a12a7e9b9931c8c799e297/68747470733a2f2f61646f6f7265692e73332e75732d656173742d322e616d617a6f6e6177732e636f6d2f696d616765732f6c6f6a655f74657374655f6c6f676f61646f6f7265695f313636323437363636332e706e67" width="160" data-canonical-src="https://adoorei.s3.us-east-2.amazonaws.com/images/loje_teste_logoadoorei_1662476663.png" style="max-width: 100%;"></a>
</p>

# Adoorei Api - Teste Técnico

### Descrição
API para cadastro de produtos e vendas

### Pré-requisitos
#### Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
- [Git](https://git-scm.com)
- [Docker](https://www.docker.com/)
```
# Clone o repositório
$ git clone https://github.com/aleesilva/adoorei-api.git
```

```
# Acesse a pasta do projeto no terminal/cmd
$ cd adoorei-api
```
### Rodando a aplicação
```
# Execute o comando para subir o container
$ docker-compose up -d
```
### A aplicação estará disponível em:
```
http://localhost:9090
```

### Documentação da API & Testes
[Swagger](http://localhost:9090/api/docs)

### Também Está disponível a api em uma versão utilizando GraphQL
[GraphQL](http://localhost:9090/graphiql) o graphql playground já tem a própria documentação e autocomplete das queries e mutations disponíveis.


```
php artisan test
```

### 🛠 Tecnologias
As seguintes ferramentas foram usadas na construção do projeto:

### Para rodar a suite de testes


<p align="center">
    <img src="https://img.shields.io/badge/Swagger-85EA2D?style=for-the-badge&logo=swagger&logoColor=black" alt="Swagger" />
    <img src="https://img.shields.io/badge/GrahpQL-E10098?style=for-the-badge&logo=graphql&logoColor=white" alt="GraphQL" />
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
    <img src="https://img.shields.io/badge/Potsgres-336791?style=for-the-badge&logo=postgresql&logoColor=white" alt="Postgres" />
    <img src="https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker" />
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
    <img src="https://img.shields.io/badge/Swoole-8DD6F9?style=for-the-badge&logo=swoole&logoColor=black" alt="Swoole" />
    <img src="https://img.shields.io/badge/Pest-8DD6F9?style=for-the-badge&logo=pest&logoColor=black" alt="Pest" />
</p>
