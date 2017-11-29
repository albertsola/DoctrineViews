# Doctrine Views

Fix schema diff and doctrine migrations issues when you are using Doctrine ORM and mapping Views as Entities.

Note: This is a **hack** I build this as a package but I really encourage you to just copy and paste the `src/MysqlViewsPlatform.php` file to your project.

Stackoverflow question: https://stackoverflow.com/questions/47477324/how-to-stop-doctrine-trying-to-create-a-table-for-a-view-that-has-been-mapped-on

## The issue

You can map a view as an Entity in Doctrine and it works fine. Although this cause side effects during the execution of the following commands:

* app/console doctrine:schema:validate
* app/console doctrine:schema:update
* app/console doctrine:migrations:generate

This commands create a new table with the name of the view as doctrine ignores everything is not a table during the validation of the schema. This **hack** just tells doctrine to consider all types of tables. 

## Using this package
### Symfony usage:

Create a service:
```yaml
services:
    doctrine.dbal.mysql_views_platform:
        class: albertsola\DoctrineViews\MysqlViewsPlatform
        arguments: []
```

Set that service as a connection platform
```yaml
doctrine:
    dbal:
        default_connection: default
        connections:
            default:
                driver:   "%database_driver%"
                host:     "database_host%"
                port:     "database_port%"
                dbname:   "database_name%"
                user:     "database_user%"
                password: "database_password%"
                charset:   UTF8
                platform_service: "doctrine.dbal.mysql_views_platform"
```

### Other frameworks

```php
<?php
$myPlatform = new MysqlViewsPlatform();
$options = array(
    //[...]
    'platform' => $myPlatform
);
$conn = DriverManager::getConnection($options);
```
