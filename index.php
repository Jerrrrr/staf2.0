<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

$routes = array(


    'home' => array(
        'controller' => 'Dashboard',
        'action' => 'dashboard'
    ),
        'login' => array(
            'controller' => 'Dashboard',
            'action' => 'login'
            ),
        'logout' => array(
            'controller' => 'Dashboard',
            'action' => 'logout'
            ),
        'register' => array(
            'controller' => 'Dashboard',
            'action' => 'register'
            ),
        'update' => array(
            'controller' => 'Dashboard',
            'action' => 'update'
        ),
        'update_normal' => array(
            'controller' => 'Dashboard',
            'action' => 'update_normal'
        ),
        'update_super' => array(
            'controller' => 'Dashboard',
            'action' => 'update_super'
        ),
        'update_user' => array(
            'controller' => 'Dashboard',
            'action' => 'update_user'
        ),
        'delete' => array(
            'controller' => 'Dashboard',
            'action' => 'delete'
            ),

    'week' => array(
        'controller' => 'Week',
        'action' => 'week'
    ),
        'dagen' => array(
            'controller' => 'Week',
            'action' => 'dagen'
        ),
        'weken' => array(
            'controller' => 'Week',
            'action' => 'weken'
        ),
        'fiscaal' => array(
           'controller' => 'Week',
           'action' => 'fiscaal'
        ),

    'kinderen' => array(
       'controller' => 'Kinderen',
       'action' => 'gegevens'
    ),
        'voegtoe' => array(
           'controller' => 'Kinderen',
           'action' => 'toevoegen'
        ),
        'weizig' => array(
           'controller' => 'Kinderen',
           'action' => 'weizigen'
        ),
        'ouders' => array(
            'controller' => 'Kinderen',
            'action' => 'ouders'
         ),
         'downloadOuders' => array(
            'controller' => 'Kinderen',
            'action' => 'downloadOuders'
         ),
        'zetActief' => array(
           'controller' => 'Kinderen',
           'action' => 'zetActief'
        ),
        'verwijder' => array(
           'controller' => 'Kinderen',
           'action' => 'verwijder'
        ),

    'uitstappen' => array(
       'controller' => 'Uitstap',
       'action' => 'index'
    ),
        'uitstap_detail' => array(
           'controller' => 'Uitstap',
           'action' => 'detail'
        ),
        'uitstap_edit' => array(
           'controller' => 'Uitstap',
           'action' => 'editAdd'
        ),
        'uitstap_add_child' => array(
           'controller' => 'Uitstap',
           'action' => 'addChild'
        )

    // 'old_home' => array(
    //     'controller' => 'Staf',
    //     'action' => 'index'
    // ),
    //     'staf' => array(
    //         'controller' => 'Staf',
    //         'action' => 'staf'
    //     ),
    //     'add' => array(
    //         'controller' => 'Staf',
    //         'action' => 'add'
    //     )

);

if(empty($_GET['page'])) {
    $_GET['page'] = 'home';
}
if(empty($routes[$_GET['page']])) {
    header('Location: index.php');
    exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once WWW_ROOT . 'controller' . DS . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();
