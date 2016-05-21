<?php

namespace Src\Controller;

use Core\Controller;
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
        $author = $author->find('email', $this->session->get('email'));

        $expert = new Expert();
        $expert = $expert->find('email', $this->session->get('email'));

        $categories = new Category();
        $categories = $categories->findAll();

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
        if($this->request->isPOst()){
            $author = new Author();
            $author = $author->find('email', $this->session->get('email'));
            $author->name = $this->request->get('changed_name');
            $author->update();
        }
    }

    public function becomeExpert()
    {
        if($this->request->isPost()){
            $expert = new Expert();
            $expert->name = $this->request->get('expert_name');
            $expert->email = $this->session->get('email');
            $expert->photo = $this->request->get('expert_photo');
            $expert->description = $this->request->get('description');
            $expert->save();

            $current_expert = $expert->find('email', $expert->email);

            $categories = $this->request->get('category');
            foreach($categories as $var){
                $cat_exp = new Category_has_Expert();
                $cat_exp->category_id = $var;
                $cat_exp->expert_id = $current_expert->id;
                $cat_exp->save();
            }
        }
    }
}