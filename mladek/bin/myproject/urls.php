<?php
use mladek::conf::urls::urls;


urls::patterns(array(

    array('^$', 'myproject::myapp::views::mymethod'),
    
));
