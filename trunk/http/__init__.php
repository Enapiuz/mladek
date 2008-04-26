<?php
namespace mladek::http;


class HttpResponse
{
    public function __construct($text)
    {
        $this->text = $text;
    }

    public function render()
    {
        print $this->text;
    }

}


final class Http404 extends HttpResponse
{
    
    public function render()
    {
        Header('');
        $this->text = 'Error 404. '.$this->text;
        parent::render();
    }
}
