<?php
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="cf bg3 fs14 lh20 p15-25 semibold mb10">
    <a class="back-menu" href="<?=Url::toRoute('/profile/menu/index')?>" title="Назад"><span class="glyphicon glyphicon-remove-sign cf fs12 mr5px" aria-hidden="true"></span></a> Настройки <a href="<?=Url::toRoute('/profile/window/help')?>" class="window-link" data-toggle="modal" data-target="#help-modal"><span class="glyphicon glyphicon-question-sign top-2px c8 fs24 pull-right" aria-hidden="true"></span></a>
</div>
<?$form = ActiveForm::begin(['id' => 'edit-site-form']);?>
    <a href="#site-info" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="site-info">Информация о сайте <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="site-info">
        <div class="pl25px pr25px">
            <?=$form->field($modelSeo, 'title',[
                'inputOptions' => ['class' => 'form-control input-lg dark', 'placeholder' => 'Введите тайтл'],
                'hintOptions'  => ['class' => 'fs12 lh18 c5 mb5'],
                'labelOptions' => ['class' => 'control-label c8'],
                'template'     => "{label}\n{hint}\n{input}\n{error}",
            ])->hint('Нужно добавить информацию о тайтле');?>
            <?=$form->field($modelSeo, 'description',[
                'inputOptions' => ['class' => 'form-control input-lg dark autosize one-line', 'placeholder' => 'Введите дескрипшен'],
                'hintOptions'  => ['class' => 'fs12 lh18 c5 mb5'],
                'labelOptions' => ['class' => 'control-label c8'],
                'template'     => "{label}\n{hint}\n{input}\n{error}",
            ])->textArea()->hint('Нужно добавить информацию о тайтле');?>
        </div>
    </div>
    <a href="#site-domain" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="site-domain">Домен <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="site-domain">
        <div class="pl25px pr25px">
            <?=$form->field($model, 'code',[
                'inputOptions' => ['class' => 'form-control input-lg dark pr75', 'placeholder' => 'Введите название'],
                'hintOptions'  => ['class' => 'fs12 lh18 c5 mb5'],
                'labelOptions' => ['class' => 'control-label c8 mb5'],
                'template'     => "{label}\n{hint}\n<div class='relative'>{input}<span class='absolute top0 right0 c8 pt10 pr10'>.theicon.ru</span></div>\n{error}",
            ]);?>
            <?=$form->field($modelSeo, 'description',[
                'inputOptions' => ['class' => 'form-control input-lg dark', 'placeholder' => 'Введите дескрипшен'],
                'hintOptions'  => ['class' => 'fs12 lh18 c5 mb5'],
                'labelOptions' => ['class' => 'control-label c8'],
                'template'     => "{label}\n{hint}\n{input}\n{error}",
            ])->hint('Нужно добавить информацию о тайтле');?>
            <div class="mb35">
                <?=Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);?>
                <?=Html::a('Отмена', Url::toRoute('/profile/menu/index'), ['class' => 'btn btn-link cf back-menu'])?>
            </div>
        </div>
    </div>
<?ActiveForm::end();?>