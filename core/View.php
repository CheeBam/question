<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 04.05.16
 * Time: 1:16
 */

namespace Core;


class View
{
    public $path;

    public $extension;

    public $vars = [];

    public function __construct($config = array())
    {
        $this->path = $config['views_path'];
        $this->extension = $config['views_extension'];
    }

    public function add($vars, $name = '')
    {
        if(is_array($vars)) {
            $this->vars = array_merge($this->vars, $vars);
        }else if(empty($name)){
            throw new \Exception('Variable not added!');
        }else{
            $this->vars[$name] = $vars;
        }
        return $this;
    }

    public function render($path, $vars = '')
    {
        $this->path = $this->path . strtolower($path) . $this->extension;
        if(!empty($vars)){
            $this->vars = array_merge($this->vars, $vars);
        }
        ob_start();
        extract($this->vars);
        include $this->path;
        return ob_get_clean();
    }
}