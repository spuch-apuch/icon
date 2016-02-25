<?php
use yii\helpers\ArrayHelper;
?>
<li>
    <?=$form->field($model, $field, [
        'options'  => ['class' => 'form-group relative mb0'],
        'template' => "{input}\n{label}\n{error}",
    ])->dropDownList($list, [
        'class' => 'selectpicker font-select absolute top0 left0 right0',
        'data-style' => 'btn-link',
        'data-live-search' => 'true',
        'data-live-search-placeholder' => 'Поиск по названию шрифта',
        'data-target-style' => "#site-{$style}",
        'options' => ArrayHelper::map($fonts, 'css_class', 'attr'),
    ])->label($model->getAttributeLabel('design_font'), [
        'class' => 'btn btn-link dropdown-toggle c7d',
        'id'    => "dropdown-{$field}",
        'type'  => 'button',
    ]);?>
</li>
