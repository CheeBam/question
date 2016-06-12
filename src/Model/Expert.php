<?php

namespace Src\Model;

use Core\Model;

class Expert extends Model implements ModelInterface
{
    public $id;

    public $name;

    public $email;

    public $photo;

    public $description;

    public $count_of_ans;

    public $rating;

    public function getTable()
    {
        return 'expert';
    }

    public function getColumn()
    {
        return array('id', 'name', 'email', 'photo', 'description', 'count_of_ans', 'rating');
    }

}