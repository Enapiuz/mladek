<?php
use mladek::conf::urls::urls;

urls::patterns(array(

    array('^article/', urls::inc('myproject::myapp::urls')),
    array('^$', 'myproject::myapp::views::mymethod'),
    
));
