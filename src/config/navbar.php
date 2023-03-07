<?php

return[
    '' => [
        'all' => [
            ''
        ],
        'noLogined' => [        
            '<a href="/" class="button interactive-element">Войти</a>',
        
        ],
        'isLogined' => [
            '<a href="/" class="account button interactive-element_2">
            <img src="https://minotar.net/avatar/'.$_SESSION['Login'].'" alt="">
            <div class="login">'.$_SESSION['Login'].'</div>
            </a>'
        ],
        'admin' => [
            
        ]
    ],
    'Account/Login' => [
        'all' => [
            
        ],
        'noLogined' => [        
          
            
        ],
        'isLogined' => [
            
        ],
        'admin' => [
    
        ]
    ]
];