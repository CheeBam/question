<?php

namespace Src\Controller;

use Core\Controller;
use Core\V;
use Src\Model\Category;
use Src\Model\Category_has_Expert;
use Src\Model\Expert;
use Src\Model\Question;

class IndexController extends Controller
{

    public function __construct($di)
    {
        parent::__construct($di);
    }

    public function index()
    {
        $category = new Category();
        $expert = new Expert();
        $question = new Question();

        $all_cats = $category->setPDO($this->pdo)->findAll();
        $all_exp = $expert->setPDO($this->pdo)->findAll();

        $question->setPDO($this->pdo);

        foreach ($all_exp as $key => $value){
            $all_quest = $question->findByKey(['answer','rating'], 'expert_id', $all_exp[$key]->id, null, false, true);

            if(empty($all_quest)){
                $all_exp[$key]->count_of_ans = 0;
                $all_exp[$key]->rating = 0;
            }else{
                $rateSum = 0;
                $count = 0;
                foreach ($all_quest as $new_var){
                    if($new_var['answer'] === '') continue;
                    $rateSum += $new_var['rating'];
                    $count++;
                }
                $all_exp[$key]->count_of_ans = $count;
                $all_exp[$key]->rating = round($rateSum / $count, 1);
            }
            $all_exp[$key]->setPDO($this->pdo)->update();
        }

        $experts = $expert->findByKey('*', 1, 1, 'rating', false, true);

        $vars = [
            'logged'    => $this->auth->verifyLog(),
            'uri'       => $this->auth->getAuthUri(),
            'all_cats'  => $all_cats,
            'experts'   => $experts
        ];

        return $this->view->add($vars)->render('index');
    }

    public function showCategory($category_id)
    {
        $category = new Category();
        $cat_expert = new Category_has_Expert();

        $current_category = $category->setPDO($this->pdo)->find('id', $category_id);
        if(!$current_category) return $this->view->render('404');

        $nums_experts = $cat_expert->setPDO($this->pdo)->findByKey('expert_id', 'category_id', $category_id, null, true, true, \PDO::FETCH_COLUMN);

        $experts = [];
        foreach($nums_experts as $var){
            $exp = new Expert();
            $exp = $exp->setPDO($this->pdo)->find('id', $var);
            if($this->auth->verifyLog() && $exp->email === $this->session->get('email')) continue;
            $experts[] = $exp;
        }

        $vars = [
            'logged'    => $this->auth->verifyLog(),
            'uri'       => $this->auth->getAuthUri(),
            'cat_name'  => $current_category->name,
            'experts'   => $experts
        ];

        return $this->view->add($vars)->render('category');
    }

    public function notFound()
    {
        return $this->view->render('404');
    }

}
