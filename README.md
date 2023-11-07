# Symfony Docker
Used boilerplate repo (https://github.com/dunglas/symfony-docker)

 with runtime for the [Symfony](https://symfony.com) web framework,
with [FrankenPHP](https://frankenphp.dev) and [Caddy](https://caddyserver.com/) inside!

Products REST API:
- check requests.http file to run some requests


- GET /api/product/list
- POST /api/product/new
- PUT /api/product/update/{id} 
- DELETE /api/product/delete/{id} 
- GET /api/product/show/{id}

  [view all products in table](https://localhost/api/product/list)

## Getting Started

1. Run `docker compose build --no-cache` to build fresh images
2. Run `docker compose up -d --wait` to start the project 
3. Run below commands in ~~terminal in project or~~ php container:

       composer require symfony/orm-pack 
       composer require symfony/twig-bundle 
       composer require --dev orm-fixtures

       php bin/console doctrine:migrations:migrate 
       php bin/console doctrine:fixtures:load


or `XDEBUG_MODE=debug docker compose up -d`

[//]: # (4. Run php bin/console doctrine:fixtures:load in php docker container)


------

* used Symfony autowire
* used ProductService as Command and ProductRepository as Query
* used Symfony EntityValueResolver to simplify contronller
----
CQS

ProductController <-> ProductRepository <- ManagerRegistry

ProductController <-> ProductService -> EntityManager
