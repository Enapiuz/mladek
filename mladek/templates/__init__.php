<?php
namespace mladek::templates;

use mladek::settings;


final class Template
{
    public $t;
    public $text = '';
    public $template = null;

    public function __construct($text = '')
    {

        include_once 'smarty/Smarty.class.php';
        $this->t = new ::Smarty;

        $this->t->template_dir = settings::PROJECT_DIR.'/templates';
        $this->t->compile_dir = settings::PROJECT_DIR.'/tmp/templates_c';

        $this->t->compile_check = true;
        $this->t->debugging = false;

        $this->text = $text;
    }

    static function get_template($template)
    {
        $t = new Template('');
        $t->template = $template;
        return $t;
    }
    
    public function render(Context $context)
    {
        foreach ($context->params as $key => $param) {
            $this->t->assign($key, $param);
        }
        if (null !== $this->template) {
            return $this->t->fetch($this->template);
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
