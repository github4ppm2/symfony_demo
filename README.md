Symfony 3.2.8 Demo
========================

Welcome to the Symfony 3.2.8 Demo - Steps for configuration are given below.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

Steps-
--------------

  * Clone this repository - https://github.com/github4ppm2/symfony_demo.git

  * Make a copy of ``` app/config/parameters.yml.dist ``` as ``` app/config/parameters.yml ``` and set your database credentials.

  * Update dependencies by composer - ``` composer install ```

  * Migrate Database migrations ``` php bin/console doctrine:migrations:update --force ```

All Done !
