<?php
use yii\helpers\Html;
?>
<div id="<?=$field?>-cont" class="color-picker inl-bl ml15 mr15 relative" data-container="#<?=$field?>-cont" data-input="#site-<?=$field?>" data-inline="true"<?=($addon ? ' data-component="' . $addon . '"' : '')?>>
    <?$r = '<div class="text-center pull-left mr10px">' . Html::input('text', "site-{$field}", '', [
            'id'          => "site-{$field}_r",
            'class'       => 'rgb-input',
        ]) . Html::label('R', "site-{$field}_r", ['class' => 'c8']) . '</div>';?>
    <?$g = '<div class="text-center pull-left mr10px">' . Html::input('text', "site-{$field}", '', [
            'id'          => "site-{$field}_g",
            'class'       => 'rgb-input',
        ]) . Html::label('G', "site-{$field}_g", ['class' => 'c8']) . '</div>';?>
    <?$b = '<div class="text-center pull-left mr10px">' . Html::input('text', "site-{$field}", '', [
            'id'          => "site-{$field}_b",
            'class'       => 'rgb-input',
        ]) . Html::label('B', "site-{$field}_b", ['class' => 'c8']) . '</div>';?>
    <?=$form->field($model, $field,[
        'labelOptions' => ['class' => 'c8'],
        'inputOptions' => ['class' => ''],
        'options'      => ['class' => 'form-group mt10 mb5 mr-10px clear-after'],
        'template'     => "<div class=\"text-center pull-left mr10px\">{input}{label}</div>{$r}{$g}{$b}\n{error}",
    ])->label('Hex');?>
</div>