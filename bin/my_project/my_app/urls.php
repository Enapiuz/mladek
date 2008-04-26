<?php
use mladek::core::urls;

urls::patterns(array(

    array('^(\d+)/$', 'views::article', 'name'=>'article'),
    
));
