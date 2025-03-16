<?php

namespace Tecgdcs\Screencast;

class Response
{
    public static function abort()
    {
        die('Oups un problème technique est survenu !');
    }

    public static function redirect(string $url)
    {
/*        echo 'hey';
        return __DIR__.'/'.$url;*/
        header('Location: '.${$url});
        exit;
    }

    public static function back()
    {
    echo 'hallo';
        header('Location: '.${$_SERVER['HTTP_REFERER']});
        exit;
    }


}