<?php


$routes = [
    [
        'Route' => '',
        'Controller' => 'Home',
        'Action' => 'Index',
        'Layout' => 'Default',
        'View' => 'Index',
        'Title' => 'Главная'
    ],
    [
        'Route' => 'Account/Login',
        'Controller' => 'Account',
        'Action' => 'login',
        'Layout' => 'Default',
        'View' => 'Login',
        'Title' => 'Главная'
    ],
    [
        'Route' => 'Account/Signup',
        'Controller' => 'Account',
        'Action' => 'Signup',
        'Layout' => 'Default',
        'View' => 'Signup',
        'Title' => 'Главная'
    ],
    [
        'Route' => 'Account',
        'Controller' => 'Account',
        'Action' => 'Index',
        'Layout' => 'Default',
        'View' => 'Index',
        'Title' => 'Аккаунт'
    ],
    [
        'Route' => 'Account/Logout',
        'Controller' => 'Account',
        'Action' => 'Logout',
        'Layout' => 'Default',
        'View' => 'Logout',
        'Title' => 'Аккаунт'
    ],
    [
        'Route' => 'Account/Settings',
        'Controller' => 'Account',
        'Action' => 'Settings',
        'Layout' => 'Default',
        'View' => 'Settings',
        'Title' => 'Аккаунт'
    ],
    [
        'Route' => 'Account/Sessions',
        'Controller' => 'Account',
        'Action' => 'Sessions',
        'Layout' => 'Default',
        'View' => 'Sessions',
        'Title' => 'Аккаунт'
    ],
    [
        'Route' => 'Error/404',
        'Controller' => 'Error',
        'Action' => 'Error404',
        'Layout' => 'Default',
        'View' => 'Error404',
        'Title' => 'Ошибка'
    ],
    
];

return $routes;
