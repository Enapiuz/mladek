<?php
use mladek::core::urls;

urls::patterns(
    array('^$', 'my_project::my_app::views::my_method')

);
