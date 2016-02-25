<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
?>
<table class="w100pc h100vh">
    <tr>
        <td class="panelbar bg0">
            <div id="panel">
                <ul>
                    <li><a href="<?=Url::toRoute('grid')?>">Сетка</a></li>
                    <li><a href="<?=Url::toRoute('design')?>">Дизайн</a></li>
                    <li><a href="<?=Url::toRoute('content')?>">Контент</a></li>
                    <li><a href="<?=Url::toRoute('settings')?>">Настройки</a></li>
                    <li><a href="<?=Url::toRoute('')?>">Профиль</a></li>
                    <li><a href="<?=Url::toRoute('/site/tarif')?>">Изменить тариф</a></li>
                    <li><a href="<?=Url::toRoute('/site/help')?>">Помощь</a></li>
                    <li><a href="<?=Url::toRoute('/site/logout')?>" data-method="post">Выйти</a></li>
                </ul>
            </div>
        </td>
        <td><iframe class="w100pc h100pc" id="frame" src="http://theicon.loc/profile/view-pages/"></iframe></td>
    </tr>
</table>