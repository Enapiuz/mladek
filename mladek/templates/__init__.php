<?php
namespace mladek::templates;

use mladek::conf::conf;


function get_template($file)
{
    $t = new Template('');
    $t->file = $file;
    return $t;
}

final class Template
{
    public $t;
    public $text = '';
    public $file = null;

    public function __construct($text = '')
    {

        include_once 'smarty/Smarty.class.php';
        $this->t = new ::Smarty;

        $this->t->template_dir = conf::get('PROJECT_DIR').'/templates';
        $this->t->compile_dir = conf::get('PROJECT_DIR').'/templates_c';

        $this->t->compile_check = true;
        $this->t->debugging = false;

        $this->text = $text;
    }
    
    public function render(Context $context)
    {
        foreach ($context->params as $key => $param) {
            $this->t->assign($key, $param);
        }
        if (null !== $this->file) {
            $this->t->display($this->file);
        } else {
//            $this->template->display($this->text);
        }
    }
}


final class Context
{
    public $params = array();

    public function __construct($params)
    {
        $this->params = $params;
    }

}
