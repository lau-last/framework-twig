<?php

define('ROOT', \dirname(__DIR__));

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once '../vendor/autoload.php';

(new \DevCoder\DotEnv(ROOT . '/.env'))->load();

\App\SessionBlog\SessionBlog::start();

(new \Core\Router\Router(require ROOT . '/config/routes.php'))->run(new \Core\Http\Request());
