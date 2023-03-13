<div class="content">
    <form action="" method="POST" class="form sessionForm">
        <div class="sessionForm-title">Текущий сеанс</div>
        <div class="element">
            <div class="icon">
                <img src="/public/icons/pc-icon.svg" alt="">
            </div>
            <div class="content">
                <div class="os"><?=$vars[1][0][4]?></div>
                <div class="location"><?=$vars[1][0][3]?></div>
                <div class="other">
                    <div class="browser"><?=$vars[1][0][5]?>&nbsp·&nbsp</div>
                    <div class="time"><?=date('j.n.Y в H:i', $vars[1][0][7])?></div>
                </div>
            </div>
        </div>
        <button class="close-all button interactive-element">Закрыть другие сессии</button>
    </form>


    <form action="" method="POST" class="form sessionForm">
        <div class="sessionForm-title">Другие сеансы</div>
        
        <?php
        if($vars[0] != ''){
            for($i=0;$i< count($vars[0]); $i++){
                echo '
                <div class="element">
                    <div class="icon">
                        <img src="/public/icons/pc-icon.svg" alt="">
                    </div>
                    <div class="content">
                        <div class="os">'.$vars[0][$i][4].'</div>
                        <div class="location">'.$vars[0][$i][3].'</div>
                        <div class="other">
                            <div class="browser">'.$vars[0][$i][5].'&nbsp·&nbsp</div>
                            <div class="time">'.date('j.n.Y в H:i', $vars[0][$i][7]).'</div>
                        </div>
                    </div>
                </div>
                ';
            }
        }
        
        ?>
    </form>

    

    

</div>
