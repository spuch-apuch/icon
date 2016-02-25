<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h4 class="modal-title fs22 lh25" id="create-site-modal-label">Создать новый сайт</h4>
        </div>
        <?$form = ActiveForm::begin(['id' => 'create-site-form']);?>
        <div class="modal-body">
            <?=$form->field($model, 'name',[
                'inputOptions' => ['class' => 'form-control input-lg', 'placeholder' => 'Введите название'],
                'hintOptions'  => ['class' => 'fs12 lh18 c8'],
            ])->hint('Введите название, которое будет отображаться в карте сайта');?>
            <?=$form->field($model, 'pageName',[
                'inputOptions' => ['class' => 'form-control input-lg', 'placeholder' => 'Введите заголовок'],
                'hintOptions'  => ['class' => 'fs12 lh18 c8'],
            ])->hint('Заголовок страницы отображается на вкладке браузера');?>
            <?=$form->field($model, 'description',[
                'inputOptions' => ['class' => 'form-control input-lg autosize', 'placeholder' => 'Введите описание'],
                'hintOptions'  => ['class' => 'fs12 lh18 c8'],
            ])->textArea()->hint('Заголовок страницы отображается на вкладке браузера');?>
        </div>
        <div class="modal-footer">
            <?=Html::submitButton('Создать', ['class' => 'btn btn-primary']);?>
        </div>
        <?ActiveForm::end();?>
    </div>
</div>