<?php
namespace mladek::core;


final class http
{
    static function response($text)
    {
        print $text;
    }

    static function response404($text)
    {
        Header('');
        print 'Error 404. ';
        print $text;
    }

}
