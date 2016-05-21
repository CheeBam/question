<?php

namespace Src\Model;

use Core\Model;

class Author extends Model implements ModelInterface
{
    public $id;

    public $google_id;

    public $email;

    public $name;

    public $access_token;

    public function getTable()
    {
        return 'author';
    }

    public function getColumn()
    {
        return array('google_id' ,'email', 'name', 'access_token');
    }
}