<?php

trait DatabaseTrait
{
    use DisableForeignKeys,TruncateTable;
    private $dbconfig;

    public function __construct()
    {
        $this->dbconfig = config('application.database.mysql');

    }
}
