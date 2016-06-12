<?php

namespace Src\Controller;

use Core\Controller;
use Core\V;
use Src\Model\Author;
use Src\Model\Category;
use Src\Model\Category_has_Expert;
use Src\Model\Expert;

class SettingsController extends Controller
{
    public function __construct($di)
    {
        parent::__construct($di);
    }

    public function settings()
    {
        if(!$this->auth->verifyLog()){
            $vars = [
                'quest'     => true,
                'uri'       => $this->auth->getAuthUri()
            ];
            return $this->view->add($vars)->render('404');
        }

        $author = new Author();
        $author = $author->setPDO($this->pdo)->find('email', $this->session->get('email'));

        $expert = new Expert();
        $expert = $expert->setPDO($this->pdo)->find('email', $this->session->get('email'));

        $categories = new Category();
        $categories = $categories->setPDO($this->pdo)->findAll();

        $vars = [
            'logged'     => true,
            'name'       => $author->name,
            'categories' => $categories,
            'expert'     => $expert
        ];

        return $this->view->add($vars)->render('settings');
    }

    public function changeName()
    {
        $author = new Author();
        $author = $author->setPDO($this->pdo)->find('email', $this->session->get('email'));
        $author->name = $this->request->get('changed_name');
        $author->setPDO($this->pdo)->update();
    }

    public function becomeExpert()
    {
        $expert = new Expert();
        $expert->name = $this->request->get('expert_name');
        $expert->email = $this->session->get('email');
        $expert->photo = $this->request->get('expert_photo');
        $expert->description = $this->request->get('description');
        $expert->setPDO($this->pdo)->save();

        $current_expert = $expert->find('email', $expert->email);

        $categories = $this->request->get('category');

        foreach($categories as $var){
            $cat_exp = new Category_has_Expert();
            $cat_exp->category_id = $var;
            $cat_exp->expert_id = $current_expert->id;
            $cat_exp->setPDO($this->pdo)->save();
        }
    }
}