<?php
use mladek::conf::urls::urls;

urls::patterns(array(

    array('^article/', urls::inc('my_project::my_app::urls')),
    array('^$', 'my_project::my_app::views::my_method'),
    
));
