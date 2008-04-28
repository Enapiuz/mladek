<?php
namespace mladek::http;


final class HttpRequest
{
    public $GET = array();
    public $POST = array();
    public $FILES = array();
    public $REQUEST = array();
    public $COOKIE = array();

    public function __construct()
    {
        $this->GET = $_GET;
        $this->POST = $_POST;
        $this->FILES = $_FILES;
        $this->REQUEST = $_REQUEST;
        $this->COOKIE = $_COOKIE;
    }
}

class HttpResponse
{
    public $body = '';
    
    public function __construct($body)
    {
        $this->body = $body;
    }

    public function render()
    {
        print $this->body;
    }

}


final class Http404 extends HttpResponse
{
    public function render()
    {
        Header('');
        $this->body = 'Error 404. '.$this->body;
        parent::render();
    }
}



final class HttpResponseRedirect extends HttpResponse
{
    public function render()
    {
        Header('Location: '.$this->body);
        exit;
    }
}

