<?php
/**
 * Created by PhpStorm.
 * User: asola
 * Date: 29/11/2017
 * Time: 19:30
 */

namespace albertsola\DoctrineViews;


class MysqlViewsPlatform extends \Doctrine\DBAL\Platforms\MySqlPlatform
{
    public function getListTablesSQL()
    {
        return "SHOW FULL TABLES";
    }
}