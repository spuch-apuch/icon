<?php
use yii\helpers\Html;
?>
<li>
    <?=$form->field($model, $field, [
        'inline'  => true,
        'options' => ['class' => 'form-group dropdown mb0'],
        'inlineRadioListTemplate' => "{label}\n{input}\n{error}",
    ])->radioList($list, [
        'class'       => 'btn-group dropdown-menu left-auto mt-35',
        'data-toggle' => 'buttons',
        'data-addon'  => "#{$field}-addon",
        'aria-labelledby' => "dropdown-{$field}",
        'unselect'    => null,
        'item'        => function ($index, $label, $name, $checked, $value) {
            return '<label class="btn btn-link c5 pl15 pr15 nowrap' . ($checked ? ' active' : '') . ($value ? " {$value}" : '') . '">' . Html::radio($name, $checked, ['value' => $value, 'class' => 'change-addon']) . $label . '</label>';
        },
    ])->label($model->getAttributeLabel($label) . '<span class="default-addon pull-right pr18 c5" id="' . $field . '-addon"><span>' . $list[$model->$field] . '</span></span>', [
        'class'         => 'btn btn-link dropdown-toggle c7d',
        'id'            => "dropdown-{$field}",
        'type'          => 'button',
        'data-toggle'   => 'dropdown',
        'aria-haspopup' => 'true',
        'aria-expanded' => 'false',
    ]);?>
</li>