Symfony 3.2.8 Demo
========================

Welcome to the Symfony 3.2.8 Demo - Steps for configuration are given below.

Steps-
--------------

  * Clone this repository - https://github.com/github4ppm2/symfony_demo.git

  * Make a copy of ``` app/config/parameters.yml.dist ``` as ``` app/config/parameters.yml ``` and set your database credentials.

  * Update dependencies by composer - ``` composer install ```

  * Migrate database migrations ``` php bin/console doctrine:schema:update --force ```

All Done !
