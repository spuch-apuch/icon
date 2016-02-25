<?php
use yii\helpers\Url;
use yii\bootstrap\Html;
?>
<div class="cf bg3 fs14 lh20 p15-25 semibold">
    <a class="back-menu" href="<?=Url::toRoute('/profile/menu/index')?>" title="Назад"><span class="glyphicon glyphicon-remove-sign cf fs12 mr5px" aria-hidden="true"></span></a> Контент <a href="<?=Url::toRoute('/profile/window/help')?>" class="window-link" data-toggle="modal" data-target="#help-modal"><span class="glyphicon glyphicon-question-sign c8 fs24 pull-right" aria-hidden="true"></span></a>
</div>
<?if (count($pages)):?>
<div class="tree p15-25">
    <p class="ca semibold">Карта сайта</p>
    <ul>
        <?foreach($pages as $item):?>
        <li<?=($item['main']) ? ' class="parent"' : '';?>>
            <div><a href="#1" class="link-frame"><?=Html::encode($item['name']);?><?=($item['main']) ? ' (Главная)' : '';?></a></div>
            <?if (count($item['child'])):?>
            <ul>
                <?foreach($item['child'] as $subitem):?>
                    <li><div><a href="#11" class="link-frame"><?=Html::encode($subitem['name']);?></a></div></li>
                <?endforeach;?>
            </ul>
            <?endif;?>
            <?if ($item['main']):?>
                <a href="" class="semibold ml25px mt10 c8 lh30 block"><span class="glyphicon glyphicon-plus fs18" aria-hidden="true"></span> Добавить проект</a>
            <?endif;?>
        </li>
        <?endforeach;?>
    </ul>
    <a href="" class="semibold ml4 mt10 c8 lh30 block"><span class="glyphicon glyphicon-plus fs18" aria-hidden="true"></span> Добавить страницу</a>
</div>
<?endif;?>