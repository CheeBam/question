<?php

namespace Src\Model;

use Core\Model;

class Question extends Model implements ModelInterface
{
    public $id;

    public $text;

    public $date;

    public $answer;

    public $category_id;

    public $author_id;

    public $expert_id;

    public $rating;

    public $hash;

    public function getTable()
    {
        return 'question';
    }

    public function getColumn()
    {
        return array('id', 'text', 'date', 'answer', 'category_id', 'author_id', 'expert_id', 'rating', 'hash');
    }
}