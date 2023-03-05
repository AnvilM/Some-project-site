<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

        <!-- CSS -->
        <link rel="stylesheet" href="/public/css/template/variables.css">
        <link rel="stylesheet" href="/public/css/template/elements.css">

        <link rel="stylesheet" href="/public/css/template/main.css">
        <link rel="stylesheet" href="/public/css/template/header.css">
        <link rel="stylesheet" href="/public/css/template/footer.css">
        
        <link rel="stylesheet" href="<?=$page?>">
        <title><?= $title ?></title>
    </head>
    <body>
        <div class="root" id="root">
            <div class="header">
                <div class="logo">YUKKA</div>
                <div class="nav-bar">
                    <? foreach($vars['nav-bar'] as $element){
                        echo $element;
                    } ?>
                    
                </div>
            </div>

            <div class="main-content">
                <?= $view ?>
                
            </div>

            <div class="footer">
                <div class="things">
                    <div class="headline">Права</div>
                    <div class="content">
                        <div>Copyright © YUKKAMC 2022. Все права защищены. Сервера YUKKAMC не относятся к Mojang Studios.</div>
                        <div>ИП БАРАНОВ КИРИЛЛ ВЛАДИМИРОВИЧ (ИНН 616611368049 ОРНИП 322619600023730)</div>
                    </div>
                </div>
                <div class="papers">
                    <div class="headline">Документы</div>
                    <div class="content">
                        <div class="link"><a href="/">Договор-оферта</a> </div>
                        <div class="link"><a href="/">Политика обработки персональных данных</a></div>
                        <div class="link"><a href="/">Порядок проведения оплаты и безопасность операций</a></div>
                        
                       
                    </div>
                </div>
                <div class="contact">
                    <div class="headline">Ссылки</div>
                    <div class="content">
                        <div class="vk"></div>
                        <div class="github"></div>
                        <div class="yt"></div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
    
    
</html>