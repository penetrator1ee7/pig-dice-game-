# pig-dice-game-
* v 1.4
* This README describes project`s installation for unix-systems

### Installation 
* Lamp installation
``` 
    sudo apt-get install apache2 mysql-server php5 phpmyadmin
```   
* Load Database from dump
``` 
    mysql -h DBHOST -u DBUSER -pDBPASS DBNAME < backup/data.sql
```
* Generate documentation
 ``` 
    ./vendor/bin/openapi -o /path/whereYou/wanttokeep/it
 ```
* Run unit tests
  - To run unit tests you should have previously installed PHPUnit
  - You can do it with composer running this 
``` 
    composer require --dev phpunit/phpunit ^8
```
   Once PHPUnit is installed run this while in repoitory to test
``` 
    phpunit test.php
```
