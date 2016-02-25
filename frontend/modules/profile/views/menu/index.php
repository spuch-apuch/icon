<?php
use yii\helpers\Url;
?>
<div class="table h100vh mb0">
    <div class="table-cell middle">
        <ul class="profile-menu ls-none pl0 mb0 relative">
            <li><a href="<?=Url::toRoute('grid')?>" data-selector="#grid-site"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Сетка <span class="glyphicon glyphicon-question-sign pull-right hide" aria-hidden="true"></span></a></li>
            <li><a href="<?=Url::toRoute('design')?>" data-selector="#design-site"><span class="glyphicon glyphicon-grain" aria-hidden="true"></span> Дизайн <span class="glyphicon glyphicon-question-sign pull-right hide" aria-hidden="true"></span></a></li>
            <li><a href="<?=Url::toRoute('content')?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Контент <span class="glyphicon glyphicon-question-sign pull-right hide" aria-hidden="true"></span></a></li>
            <li><a href="<?=Url::toRoute('settings')?>" data-selector="#edit-site"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Настройки <span class="glyphicon glyphicon-question-sign pull-right hide" aria-hidden="true"></span></a></li>
            <li><a href="<?=Url::toRoute('')?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Профиль <span class="glyphicon glyphicon-question-sign pull-right hide" aria-hidden="true"></span></a></li>
            <li><a href="<?=Url::toRoute('/site/tarif')?>"><span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span> Изменить тариф <span class="glyphicon glyphicon-question-sign pull-right hide" aria-hidden="true"></span></a></li>
            <li><a href="<?=Url::toRoute('/site/help')?>"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Помощь <span class="glyphicon glyphicon-question-sign pull-right hide" aria-hidden="true"></span></a></li>
            <li><a href="<?=Url::toRoute('/site/logout')?>" data-method="post"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Выйти <span class="glyphicon glyphicon-question-sign pull-right hide" aria-hidden="true"></span></a></li>
        </ul>
    </div>
</div>
