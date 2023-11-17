<?php
require_once __DIR__ . '/config/config.php';
include __DIR__.'/app/views/e.php';
define('BASE_PATH', '/mvc/');
SPL_autoload_register(function($class){
    if(file_exists(__DIR__.'/app/controllers/'.$class.'.php'))
        {
        require __DIR__.'/app/controllers/'.$class.'.php';
        }
    if(file_exists(__DIR__ . '/lib/DB/'.$class.'.php'))
        {
        require __DIR__ . '/lib/DB/'.$class.'.php';
        }
});


$config = require 'config/config.php';
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$controller = new HotelController($db);
// $controller = new CustomerController($db);

$request = $_SERVER['REQUEST_URI']; 

        // var_dump($_SERVER);
        // var_dump($request);
switch ($request) {
            case BASE_PATH:
                $controller->index();
                break;
            case BASE_PATH . 'add':
                // var_dump($_SERVER);
                $controller->add();
                break;
            case BASE_PATH . 'show':
                $controller->show();
                break;
            case BASE_PATH . 'delete?id=' . $_GET['id']:
                // var_dump($_GET['id']);
                $controller->delete($_GET['id']);
                break;
            case BASE_PATH . 'update?id=' . $_GET['id']:
                $controller->update($_GET['id']);
                break;
            case BASE_PATH . 'edit?id=' . $_GET['id']:
                // var_dump($_GET['id']);
                $controller->edit($_GET['id']);
                break;
            default:
            // var_dump($request);
                break;
            }
?>