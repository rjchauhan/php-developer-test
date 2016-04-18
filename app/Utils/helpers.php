<?php

/**
 * Alert Helper
 *
 * @param  string|null $title
 * @param  string|null $text
 */
function alert($title = null, $text = null)
{
    $flash = app('App\Classes\Flash');

    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $text);
}