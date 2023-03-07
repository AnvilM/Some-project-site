<?php

return[
    '' => [
        'all' => [
            ''
        ],
        'noLogined' => [        
            '<a href="/account/login" class="button interactive-element">Войти</a>',
        
        ],
        'isLogined' => [
            '<a href="/account" class="account button interactive-element_2">
            <img src="https://minotar.net/avatar/'.$_SESSION['Login'].'" alt="">
            <div class="login">'.$_SESSION['Login'].'</div>
            </a>'
        ],
        'admin' => [
            
        ]
    ],
    'Account/Login' => [
        'all' => [
            '<a href="/account/Signup" class="button interactive-element">Регистрация</a>',
        ],
        'noLogined' => [        
          
            
        ],
        'isLogined' => [
            
        ],
        'admin' => [
    
        ]
    ],
    'Account/Signup' => [
        'all' => [
            '<a href="/account/login" class="button interactive-element">Вход</a>',
        ],
        'noLogined' => [        
          
            
        ],
        'isLogined' => [
            
        ],
        'admin' => [
    
        ]
    ]
];