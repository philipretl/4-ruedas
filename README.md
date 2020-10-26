# 4-ruedas Project for Laravel, Vue.js developer candidate for GradiWeb.


## Url BackEnd deploy 

https://4ruedas.venoudev.com

## Url FrontEnd deploy

in progress

### Deployment

1. clone repository.
2. Enter in the 4_ruedas_backend folder.
3. execute:
  ```
    composer install
  ```
4. execute:
  ```
    cp .env.example .env
  ```
5. execute:
  ```
    php artisan key:generate
  ```
6. execute:
  ```
    chmod -R 777 storage/*
  ```
7. configure database name and credentials:
  ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=4ruedas
    DB_USERNAME=root
    DB_PASSWORD=
  ```
## Testing

### Requirements:

1. Sqlite Installed.
2. php 7.4.
3. Composer.
4. php sqlite extension.

### Execute test

  ```
    sh test.sh
  ```
  
### Contact
  
  afelipe.vega@gmail.com
  +57 3012017499
