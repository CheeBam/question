<?php

namespace Src\Model;

use Core\Model;

class Category extends Model implements ModelInterface
{
    public $id;

    public $name;

    public function getTable()
    {
        return 'category';
    }

    public function getColumn()
    {
        return array('id', 'name');
    }


}