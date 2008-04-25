<?php
/*
credits to swizec at swizec dot com
http://cz.php.net/manual/en/function.copy.php#77238
*/
function copy_recursive($source, $target, $excludes = array())
{
    if (is_dir($source)) {
        mkdir($target);
        $d = dir($source);
        while (false !== ($entry = $d->read())){
            if ('.' === $entry or '..' === $entry or in_array($entry, $excludes)) continue;
            $Entry = $source.'/'. $entry;
            if (is_dir($Entry)) {
                copy_recursive($Entry, $target.'/'.$entry, $excludes);
                continue;
            }
            copy($Entry, $target.'/'.$entry);
        }

        $d->close();
    } else {
        copy($source, $target);
    }
}
