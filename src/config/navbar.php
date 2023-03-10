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
            
            '<a href="/account/login" class="button interactive-element">Войти</a>',
            
        ],
        'noLogined' => [        
          
            
        ],
        'isLogined' => [
            
        ],
        'admin' => [
    
        ]
    ],
    'Account/Settings' => [
        'all' => [
            
        ],
        'noLogined' => [        
           
        ],
        'isLogined' => [
            '<a href="/account" class="account button interactive-element_2">
            <img src="https://minotar.net/avatar/'.$_SESSION['Login'].'" alt="">
            <div class="login">'.$_SESSION['Login'].'</div>
            </a>',
        ],
        'admin' => [
            
        ]
    ],
    'Account/Sessions' => [
        'all' => [
            
        ],
        'noLogined' => [        
           
        ],
        'isLogined' => [
            '<a href="/account" class="account button interactive-element_2">
            <img src="https://minotar.net/avatar/'.$_SESSION['Login'].'" alt="">
            <div class="login">'.$_SESSION['Login'].'</div>
            </a>',
        ],
        'admin' => [
            
        ]
    ],
    'Account/Confirm' => [
        'all' => [
            
        ],
        'noLogined' => [        
            '<a href="/account/login" class="button interactive-element">Войти</a>',
        ],
        'isLogined' => [
            
        ],
        'admin' => [
            
        ]
    ],
    'Account/Reset' => [
        'all' => [
            
        ],
        'noLogined' => [        
            '<a href="/account/login" class="button interactive-element">Войти</a>',
        ],
        'isLogined' => [
            
        ],
        'admin' => [
            
        ]
    ],

    'Account' => [
        'all' => [
            
        ],
        'noLogined' => [        
           
        ],
        'isLogined' => [
            '<a href="/account/sessions" class="button interactive-element">Сессии</a>',
            '<a href="/account/settings" class="button interactive-element">Настройки</a>',
            '<a href="/account/logout" class="button interactive-element">Выйти</a>',
        ],
        'admin' => [
            
        ]
    ],
    

];