<?php
use mladek::conf::urls::urls;

urls::patterns(array(

    array('^(\d+)/$', 'views::article', 'name'=>'article'),
    
));
