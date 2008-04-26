<?php
use mladek::core::urls;

urls::patterns(array(

    array('^articles/', urls::inc('my_project::my_app::urls')),
    array('^/$', 'my_project::my_app::views::my_method'),
    
));
