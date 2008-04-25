<?php
use mladek::core::urls;

urls::patterns(
    array('^$', 'my_app::views::my_method')

);
