<?php
defined('VG_ACCESS') or die ('Access denied');
const TEMPLATE = 'templates/default/';
const ADMIN_TEMPLATES = 'core/admin/views/';

const COOKIE_VERSION = '1.0.0';
const CRYPT_KEY = '';
const COOKIE_TIME = 60;
const BLOCK_TIME = 3;

const QTY = 8;
const QTY_LINKS = 3;

const ADMIN_CSS_JR = [
    'styles' => [],
   'scripts' => []
];

const USER_CSS_JR = [
    'styles' => [],
    'scripts' => []
];
use core\base\exception\RouteException;

function autoloadMainClasses ($class_name){
    $class_name = str_replace('\\','/',$class_name);

    if (!@include_once $class_name . '.php'){
        throw new RouteException ('Не вірне імя файла для підключення - ' . $class_name);
    }
}
spl_autoload_register('autoloadMainClasses');