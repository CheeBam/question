<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 15.05.16
 * Time: 3:02
 */

namespace Src\Model;


use Core\Model;

class Category_has_Expert extends Model implements ModelInterface
{
    public $category_id;

    public $expert_id;

    public function getTable()
    {
        return 'category_has_expert';
    }

    public function getColumn()
    {
        return array('category_id', 'expert_id');
    }

}