<?php

namespace Src\Controller;

use Core\Controller;
use Src\Model\Author;
use Src\Model\Category;
use Src\Model\Expert;
use Src\Model\Question;

class QuestionController extends Controller
{
    public function __construct($di)
    {
        parent::__construct($di);
    }

    public function questionSubmit()
    {
        $expert = new Expert();
        $expert = $expert->setPDO($this->pdo)->find('id', $this->request->get('expert_id'));

        $author = new Author();
        $author = $author->setPDO($this->pdo)->find('email', $this->session->get('email'));

        $category = new Category();
        $category = $category->setPDO($this->pdo)->find('name', $this->request->get('category'));

        $date = new \DateTime(null, new \DateTimeZone('Europe/Kiev'));
        $question = new Question();
        $question->text = $this->request->get('question');
        $question->date = $date->format('Y-m-d H:i:s');
        $question->answer = null;
        $question->category_id = $category->id;
        $question->author_id = $author->id;
        $question->expert_id = $expert->id;
        $question->rating = null;
        $question->hash = md5($question->date);
        $question->setPDO($this->pdo)->save();

        $author_name = empty($author->name) ? '': '</p><p>Author name: '.$author->name.'</p>';

        $vars = [
            'greeting' => 'Hello. You\'ve got a question in the category: '.$category->name,
            'text'     => 'Please answer ',
            'url'      => 'http://question.com/answer/'.$question->hash,
            'footer'   => 'Author email: '.$author->email.$author_name
        ];

        $this->mailer->send($expert->email, 'New Question!', $this->view->add($vars)->render('email'));
    }

    public function radioSubmit()
    {
        $question = new Question();
        $question = $question->setPDO($this->pdo)->find('id', $this->request->get('question_id'));
        $question->rating = $this->request->get('radio_value');
        $question->setPDO($this->pdo)->update();
    }

    public function showQuestions()
    {
        if(!$this->auth->verifyLog()){
            $vars = [
                'quest'     => true,
                'uri'       => $this->auth->getAuthUri()
                ];
            return $this->view->add($vars)->render('404');
        }

        $author = new Author();
        $expert = new Expert();
        $question = new Question();
        $category = new Category();

        $author = $author->setPDO($this->pdo)->find('email', $this->session->get('email'));
        $my_questions = $question->setPDO($this->pdo)->findByKey('*', 'author_id', $author->id, 'date', false, true);
        $expert->setPDO($this->pdo);
        $category->setPDO($this->pdo);

        foreach($my_questions as $key => $value) {
            if($my_questions[$key]['answer'] === ''){
                unset($my_questions[$key]);
                continue;
            }
            $my_questions[$key]['expert_name'] = $expert->findByKey('name', 'id', $my_questions[$key]['expert_id'])['name'];
            $my_questions[$key]['category_name'] = $category->findByKey('name', 'id', $my_questions[$key]['category_id'])['name'];
        }

        $vars = [
            'logged'    => true,
            'uri'       => $this->auth->getAuthUri(),
            'questions' => $my_questions
        ];

        return $this->view->add($vars)->render('questions');
    }

    public function answer($hash)
    {
        $question = new Question();
        $question = $question->setPDO($this->pdo)->find('hash', $hash);
        if(!$question){
            return $this->view->render('404');
        }

        $author = new Author();
        $author = $author->setPDO($this->pdo)->find('id', $question->author_id);
        $author_name = isset($author->name) ? $author->name : $author->email;

        $category = new Category();
        $category = $category->setPDO($this->pdo)->find('id', $question->category_id);

        $vars = [
            'author'    => $author_name,
            'category'  => $category->name,
            'question'  => $question->text,
            'logged'    => $this->auth->verifyLog(),
            'uri'       => $this->auth->getAuthUri(),
            'answer'    => $question->answer
        ];

        return $this->view->add($vars)->render('answer');
    }

    public function answerSubmit()
    {
        $question = new Question();
        $question = $question->setPDO($this->pdo)->find('text', $this->request->get('question'));
        $question->answer = $this->request->get('answer');
        $question->setPDO($this->pdo)->update();

        $expert = new Expert();
        $expert = $expert->setPDO($this->pdo)->find('id', $question->expert_id);

        $author = new Author();
        $author = $author->setPDO($this->pdo)->find('id', $question->author_id);

        $vars = [
            'greeting' => 'Hello. You\'ve got an answer for your question!',
            'text'     => 'You can see it ',
            'url'      => 'http://question.com/myquestions',
            'footer'   => 'Answered from '.$expert->name
        ];

        $this->mailer->send($author->email, 'Your Answer', $this->view->add($vars)->render('email'));
    }
}