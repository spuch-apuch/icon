<?php
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use app\models\Site;
?>
<div class="cf bg3 fs14 lh20 p15-25 semibold mb10">
    <a class="back-menu" href="<?=Url::toRoute('/profile/menu/index')?>" title="Назад"><span class="glyphicon glyphicon-remove-sign cf fs12 mr5px" aria-hidden="true"></span></a> Сетка сайта <a href="<?=Url::toRoute('/profile/window/help')?>" class="window-link" data-toggle="modal" data-target="#help-modal"><span class="glyphicon glyphicon-question-sign top-2px c8 fs24 pull-right" aria-hidden="true"></span></a>
</div>
<?$form = ActiveForm::begin(['id' => 'grid-site-form']);?>
    <a href="#grid-type" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="grid-type">Тип сетки <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="grid-type">
        <?=$form->field($model, 'grid_type', [
            'inline'      => true,
            'enableLabel' => false,
            'options' => ['class' => 'form-group mb0 pt5 pl25px pr25px'],
        ])->radioList($gridType, [
            'class'       => 'btn-group btn-menu',
            'data-toggle' => 'buttons',
            'unselect'    => null,
            'item'        => function ($index, $label, $name, $checked, $value) {
                return (($index % 3 == 0) ? '<div class="clear-both"></div>' : '') .
                    '<label class="btn btn-link' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) .
                    '<span class="icon-' . $value . ' fs48" aria-hidden="true"></span>
                    <span class="block lh13 mt5">' . $label . '</span>
                    </label>';
            },
        ]);?>
    </div>
    <a href="#grid-proportion" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="grid-proportion">Пропорции блоков <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="grid-proportion">
        <?=$form->field($model, 'grid_proportion', [
            'inline'      => true,
            'enableLabel' => false,
            'options' => ['class' => 'form-group mb0 pt5 pl25px pr25px'],
        ])->radioList($gridProportion, [
            'class'       => 'btn-group btn-menu',
            'data-toggle' => 'buttons',
            'unselect'    => null,
            'item'        => function ($index, $label, $name, $checked, $value) {
                return '<label class="btn btn-link' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) .
                    '<span class="icon-' . $value . ' fs48" aria-hidden="true"></span>
                    <span class="block lh13 mt5">' . $label . '</span>
                    </label>';
            },
        ]);?>
    </div>
    <a href="#grid-size" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="grid-size">Размер блоков <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="grid-size">
        <?=$form->field($model, 'grid_size', [
            'inline'      => true,
            'enableLabel' => false,
            'options' => ['class' => 'form-group mb0 pt5 pl25px pr25px'],
        ])->radioList($gridSize, [
            'class'       => 'btn-group btn-menu',
            'data-toggle' => 'buttons',
            'unselect'    => null,
            'item'        => function ($index, $label, $name, $checked, $value) {
                return '<label class="btn btn-link' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) .
                    '<span class="icon-' . $value . ' fs48" aria-hidden="true"></span>
                    <span class="block lh13 mt5">' . $label . '</span>
                    </label>';
            },
        ]);?>
    </div>
    <a href="#grid-format" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="grid-format">Формат блоков <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="grid-format">
        <?=$form->field($model, 'grid_format', [
            'inline'      => true,
            'enableLabel' => false,
            'options' => ['class' => 'form-group mb0 pt5 pl25px pr25px'],
        ])->radioList($gridFormat, [
            'class'       => 'btn-group btn-menu',
            'data-toggle' => 'buttons',
            'unselect'    => null,
            'item'        => function ($index, $label, $name, $checked, $value) {
                return '<label class="btn btn-link' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) .
                    '<span class="icon-' . $value . ' fs64" aria-hidden="true"></span>
                    <span class="block lh13 mt5">' . $label . '</span>
                    </label>';
            },
        ]);?>
    </div>
    <a href="#grid-position" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="grid-position">Расположение меню <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="grid-position">
        <?=$form->field($model, 'grid_position', [
            'inline'      => true,
            'enableLabel' => false,
            'options' => ['class' => 'form-group  mb0 pt5 pl25px pr25px'],
        ])->radioList($gridPosition, [
            'class'       => 'btn-group btn-menu',
            'data-toggle' => 'buttons',
            'unselect'    => null,
            'item'        => function ($index, $label, $name, $checked, $value) {
                return (($index % 3 == 0) ? '<div class="clear-both"></div>' : '') .
                    '<label class="btn btn-link' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) .
                    '<span class="icon-' . $value . ' fs48" aria-hidden="true"></span>
                    </label>';
            },
        ]);?>
    </div>
    <a href="#block-distance" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="block-distance">Расстояния <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="block-distance">
        <div class="pl25px pr25px">
            <?=$form->field($model, 'grid_distance', [
                'inline'      => true,
                'labelOptions' => [
                    'class'         => 'btn btn-link dropdown-toggle c8',
                    'id'            => 'dropdown-position',
                    'type'          => 'button',
                    'data-toggle'   => 'dropdown',
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'true'
                ],
                'options' => ['class' => 'form-group dropup mb0'],
                'inlineRadioListTemplate' => "{label}\n{input}\n{error}",
            ])->radioList(Site::$gridDistance, [
                'class'       => 'btn-group dropdown-menu',
                'data-toggle' => 'buttons',
                'aria-labelledby' => 'dropdown-position',
                'unselect'    => null,
                'item'        => function ($index, $label, $name, $checked, $value) {
                    return '<label class="btn btn-link c7d pl15 pr15' . ($checked ? ' active' : '') . '">' . Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
                },
            ]);?>
        </div>
    </div>
    <a href="#block-desc" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="block-desc">Описание блоков <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="block-desc">
        <div class="mb20px pl25px pr25px">
            <?=$form->field($model, 'grid_caption', [
                'inline'      => true,
                'labelOptions' => [
                    'class'         => 'btn btn-link dropdown-toggle c8',
                    'id'            => 'dropdown-position',
                    'type'          => 'button',
                    'data-toggle'   => 'dropdown',
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'true'
                ],
                'options' => ['class' => 'form-group dropup mb0'],
                'inlineRadioListTemplate' => "{label}\n{input}\n{error}",
            ])->radioList(Site::$gridCaption, [
                'class'       => 'btn-group dropdown-menu',
                'data-toggle' => 'buttons',
                'aria-labelledby' => 'dropdown-position',
                'unselect'    => null,
                'item'        => function ($index, $label, $name, $checked, $value) {
                    return '<label class="btn btn-link c7d pl15 pr15' . ($checked ? ' active' : '') . '">' . Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
                },
            ]);?>
            <?=$form->field($model, 'grid_caption_desc', [
                'options' => ['class' => 'form-group dark'],
            ])->checkbox(['label' => $model->getAttributeLabel('grid_caption_desc') . ' <span class="boxcheck"></span>']);?>
            <?=Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);?>
            <?=Html::a('Отмена', Url::toRoute('/profile/menu/index'), ['class' => 'btn btn-link cf back-menu'])?>
        </div>
    </div>
<?ActiveForm::end();?>