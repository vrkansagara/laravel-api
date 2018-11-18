<?php
/**
 * Created by PhpStorm.
 * User: vallabh
 * Date: 18/11/18
 * Time: 12:22 PM
 */

trait MigrationTrait
{
    private $dbconfig;

    public function __construct()
    {
        $this->dbconfig = config('application.database.mysql');

    }
}
