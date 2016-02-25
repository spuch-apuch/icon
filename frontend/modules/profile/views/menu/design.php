<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use app\models\Site;
use app\models\ListFont;
?>
<div class="cf bg3 fs14 lh20 p15-25 semibold mb10">
    <a class="back-menu" href="<?=Url::toRoute('/profile/menu/index')?>" title="Назад"><span class="glyphicon glyphicon-remove-sign cf fs12 mr5px" aria-hidden="true"></span></a> Дизайн <a href="<?=Url::toRoute('/profile/window/help')?>" class="window-link" data-toggle="modal" data-target="#help-modal"><span class="glyphicon glyphicon-question-sign top-2px c8 fs24 pull-right" aria-hidden="true"></span></a>
</div>
<?$form = ActiveForm::begin([
    'id'      => 'design-site-form',
    'options' => ['enctype' => 'multipart/form-data'],
]);?>
    <a href="#logo-favicon" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="grid-type">Логотип и фавикон <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="logo-favicon">
        <div class="pl25px pr25px">
            <?=$form->field($model, 'design_logo_text',[
                'inputOptions' => ['class' => 'form-control input-lg dark', 'placeholder' => 'Логотип'],
                'hintOptions'  => ['class' => 'fs12 lh18 c5 mb5'],
                'labelOptions' => ['class' => 'control-label c8 mb5'],
                'options'      => ['class' => 'form-group mb10'],
                'template'     => "{label}\n{hint}\n{input}\n{error}",
            ])->label('Логотип / Описание')->hint('Если у вас нет готового логотипа, то можете написать название и описание ниже');?>
            <?=$form->field($model, 'description',[
                'enableLabel'  => false,
                'inputOptions' => ['class' => 'form-control input-lg dark autosize one-line', 'placeholder' => 'Описание'],
                'hintOptions'  => ['class' => 'fs12 lh18 c5 mb5'],
                'labelOptions' => ['class' => 'control-label c8'],
            ])->textArea();?>
            <?=$form->field($model, 'design_logo',[
                'enableClientValidation' => false,
                'inputOptions' => ['class' => 'absolute left-9999px', 'data-uploadType' => 'logo'],
                'hintOptions'  => ['class' => 'fs12 lh18 c5 mb5'],
                'options'      => ['class' => 'form-group upload-input dark'],
                'template'     => "<label class=\"c8 mb5\">Загрузить логотип</label>\n{hint}\n<div class=\"cont relative\">{label}</div>\n{input}\n{error}",
            ])->fileInput()->hint('Максимальный размер файла не более 1 мегабайта. Финальный размер изображений 200 на 150 пикселей')
            ->label('<span class="glyphicon glyphicon-upload" aria-hidden="true"></span><span class="caption">Загрузить</span><span class="desc">Или просто перетащите файл</span>');?>
            <?=$form->field($model, 'design_favicon',[
                'enableClientValidation' => false,
                'inputOptions' => ['class' => 'absolute left-9999px', 'data-uploadType' => 'favicon'],
                'hintOptions'  => ['class' => 'fs12 lh18 c5 mb5'],
                'options'      => ['class' => 'form-group upload-input dark'],
                'template'     => "<label class=\"c8 mb5\">Загрузить фавикон</label>\n{hint}\n<div class=\"cont relative\">{label}</div>\n{input}\n{error}",
            ])->fileInput()->hint('Значок вашего сайта. Размер 16 на 16 пикселей')
            ->label('<span class="glyphicon glyphicon-upload" aria-hidden="true"></span><span class="caption">Загрузить</span><span class="desc">Или просто перетащите файл</span>');?>
        </div>
    </div>
    <a href="#color" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="grid-type">Цвет <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="color">
        <div class="pl25px pr25px">
            <div class="dropdown multi">
                <label type="button" id="bg-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Фон сайта</label>
                <div class="dropdown-menu" aria-labelledby="bg-dropdown">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-color"><span class="glyphicon glyphicon-tint" aria-hidden="true"></span> Цвет</a></li>
                        <li><a data-toggle="tab" href="#tab-image"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Изображение</a></li>
                        <li><a data-toggle="tab" href="#tab-video"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Видео</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-color" class="tab-pane fade in active">
                            <?=$this->render('form/_colorpicker', [
                                'form'  => $form,
                                'model' => $model,
                                'field' => 'design_bg_color',
                            ]);?>
                        </div>
                        <div id="tab-image" class="tab-pane fade">
                            <?=$form->field($model, 'design_bg_image',[
                                'enableClientValidation' => false,
                                'inputOptions' => ['class' => 'absolute left-9999px', 'data-uploadType' => 'bg'],
                                'options'      => ['class' => 'form-group upload-input mb10 ml15 mr15'],
                                'template'     => "<div class=\"cont relative\">{label}</div>\n{input}\n{error}",
                            ])->fileInput()->label('<span class="glyphicon glyphicon-upload" aria-hidden="true"></span><span class="caption">Загрузить</span><span class="desc">Или просто перетащите файл</span>');?>
                        </div>
                        <div id="tab-video" class="tab-pane fade">
                            <p class="mb10 ml15 mr15">Раздел в разработке.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown multi">
                <label type="button" id="menu-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Меню <span class="color-picker-addon" id="menu-color-addon"><i class="block"></i></span></label>
                <div class="dropdown-menu" aria-labelledby="menu-dropdown">
                    <?=$this->render('form/_colorpicker', [
                        'form'  => $form,
                        'model' => $model,
                        'field' => 'design_menu_color',
                        'addon' => '#menu-color-addon',
                    ]);?>
                </div>
            </div>
            <div class="dropdown multi">
                <label type="button" id="footer-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Футер <span class="color-picker-addon" id="footer-color-addon"><i class="block"></i></span></label>
                <div class="dropdown-menu" aria-labelledby="footer-dropdown">
                    <?=$this->render('form/_colorpicker', [
                        'form'  => $form,
                        'model' => $model,
                        'field' => 'design_footer_color',
                        'addon' => '#footer-color-addon',
                    ]);?>
                </div>
            </div>
        </div>
    </div>
    <?$fonts = ListFont::getFonts();
    $listFonts = ArrayHelper::map($fonts, 'css_class', 'name');?>
    <a href="#typography" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="grid-type">Типографика <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="typography">
        <div class="pl25px pr25px">
            <div class="dropdown multi">
                <label type="button" id="logo-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Логотип</label>
                <ul class="dropdown-menu pl15 pr15" aria-labelledby="logo-dropdown">
                    <?=$this->render('form/_selectpicker', [
                        'form'  => $form,
                        'model' => $model,
                        'fonts' => $fonts,
                        'list'  => $listFonts,
                        'field' => 'design_logo_font',
                        'style' => 'design_logo_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designStyle,
                        'field' => 'design_logo_style',
                        'label' => 'design_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designSize,
                        'field' => 'design_logo_size',
                        'label' => 'design_size',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designCase,
                        'field' => 'design_logo_case',
                        'label' => 'design_case',
                    ]);?>
                    <li class="dropdown multi">
                        <label type="button" id="logo-color-dropdown" class="btn btn-link dropdown-toggle c7d" aria-haspopup="true" aria-expanded="false">Цвет <span class="color-picker-addon pull-right c5" id="logo-color-addon"><i class="block"></i></span></label>
                        <div class="dropdown-menu mt-35" aria-labelledby="logo-color-dropdown">
                            <?=$this->render('form/_colorpicker', [
                                'form'  => $form,
                                'model' => $model,
                                'field' => 'design_logo_color',
                                'addon' => '#logo-color-addon',
                            ]);?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="dropdown multi">
                <label type="button" id="logo-desc-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Описание логотипа</label>
                <ul class="dropdown-menu pl15 pr15" aria-labelledby="logo-desc-dropdown">
                    <?=$this->render('form/_selectpicker', [
                        'form'  => $form,
                        'model' => $model,
                        'fonts' => $fonts,
                        'list'  => $listFonts,
                        'field' => 'design_logo_desc_font',
                        'style' => 'design_logo_desc_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designStyle,
                        'field' => 'design_logo_desc_style',
                        'label' => 'design_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designSize,
                        'field' => 'design_logo_desc_size',
                        'label' => 'design_size',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designCase,
                        'field' => 'design_logo_desc_case',
                        'label' => 'design_case',
                    ]);?>
                    <li class="dropdown multi">
                        <label type="button" id="logo-desc-color-dropdown" class="btn btn-link dropdown-toggle c7d" aria-haspopup="true" aria-expanded="false">Цвет <span class="color-picker-addon pull-right c5" id="logo-desc-color-addon"><i class="block"></i></span></label>
                        <div class="dropdown-menu mt-35" aria-labelledby="logo-desc-color-dropdown">
                            <?=$this->render('form/_colorpicker', [
                                'form'  => $form,
                                'model' => $model,
                                'field' => 'design_logo_desc_color',
                                'addon' => '#logo-desc-color-addon',
                            ]);?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="dropdown multi">
                <label type="button" id="menu-item-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Пункт меню</label>
                <ul class="dropdown-menu pl15 pr15" aria-labelledby="menu-item-dropdown">
                    <?=$this->render('form/_selectpicker', [
                        'form'  => $form,
                        'model' => $model,
                        'fonts' => $fonts,
                        'list'  => $listFonts,
                        'field' => 'design_menu_item_font',
                        'style' => 'design_menu_item_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designStyle,
                        'field' => 'design_menu_item_style',
                        'label' => 'design_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designSize,
                        'field' => 'design_menu_item_size',
                        'label' => 'design_size',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designCase,
                        'field' => 'design_menu_item_case',
                        'label' => 'design_case',
                    ]);?>
                    <li class="dropdown multi">
                        <label type="button" id="menu-item-color-dropdown" class="btn btn-link dropdown-toggle c7d" aria-haspopup="true" aria-expanded="false">Цвет <span class="color-picker-addon pull-right c5" id="menu-item-color-addon"><i class="block"></i></span></label>
                        <div class="dropdown-menu mt-35" aria-labelledby="menu-item-color-dropdown">
                            <?=$this->render('form/_colorpicker', [
                                'form'  => $form,
                                'model' => $model,
                                'field' => 'design_menu_item_color',
                                'addon' => '#menu-item-color-addon',
                            ]);?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="dropdown multi">
                <label type="button" id="item-caption-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Заголовок проекта</label>
                <ul class="dropdown-menu pl15 pr15" aria-labelledby="item-caption-dropdown">
                    <?=$this->render('form/_selectpicker', [
                        'form'  => $form,
                        'model' => $model,
                        'fonts' => $fonts,
                        'list'  => $listFonts,
                        'field' => 'design_item_caption_font',
                        'style' => 'design_item_caption_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designStyle,
                        'field' => 'design_item_caption_style',
                        'label' => 'design_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designSize,
                        'field' => 'design_item_caption_size',
                        'label' => 'design_size',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designCase,
                        'field' => 'design_item_caption_case',
                        'label' => 'design_case',
                    ]);?>
                    <li class="dropdown multi">
                        <label type="button" id="item-caption-color-dropdown" class="btn btn-link dropdown-toggle c7d" aria-haspopup="true" aria-expanded="false">Цвет <span class="color-picker-addon pull-right c5" id="item-caption-color-addon"><i class="block"></i></span></label>
                        <div class="dropdown-menu mt-35" aria-labelledby="item-caption-color-dropdown">
                            <?=$this->render('form/_colorpicker', [
                                'form'  => $form,
                                'model' => $model,
                                'field' => 'design_item_caption_color',
                                'addon' => '#item-caption-color-addon',
                            ]);?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="dropdown multi">
                <label type="button" id="item-desc-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Описание проекта</label>
                <ul class="dropdown-menu pl15 pr15" aria-labelledby="item-desc-dropdown">
                    <?=$this->render('form/_selectpicker', [
                        'form'  => $form,
                        'model' => $model,
                        'fonts' => $fonts,
                        'list'  => $listFonts,
                        'field' => 'design_item_desc_font',
                        'style' => 'design_item_desc_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designStyle,
                        'field' => 'design_item_desc_style',
                        'label' => 'design_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designSize,
                        'field' => 'design_item_desc_size',
                        'label' => 'design_size',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designCase,
                        'field' => 'design_item_desc_case',
                        'label' => 'design_case',
                    ]);?>
                    <li class="dropdown multi">
                        <label type="button" id="item-desc-color-dropdown" class="btn btn-link dropdown-toggle c7d" aria-haspopup="true" aria-expanded="false">Цвет <span class="color-picker-addon pull-right c5" id="item-desc-color-addon"><i class="block"></i></span></label>
                        <div class="dropdown-menu mt-35" aria-labelledby="item-desc-color-dropdown">
                            <?=$this->render('form/_colorpicker', [
                                'form'  => $form,
                                'model' => $model,
                                'field' => 'design_item_desc_color',
                                'addon' => '#item-desc-color-addon',
                            ]);?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="dropdown multi">
                <label type="button" id="footer-text-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Текст в футере</label>
                <ul class="dropdown-menu pl15 pr15" aria-labelledby="footer-text-dropdown">
                    <?=$this->render('form/_selectpicker', [
                        'form'  => $form,
                        'model' => $model,
                        'fonts' => $fonts,
                        'list'  => $listFonts,
                        'field' => 'design_footer_text_font',
                        'style' => 'design_footer_text_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designStyle,
                        'field' => 'design_footer_text_style',
                        'label' => 'design_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designSize,
                        'field' => 'design_footer_text_size',
                        'label' => 'design_size',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designCase,
                        'field' => 'design_footer_text_case',
                        'label' => 'design_case',
                    ]);?>
                    <li class="dropdown multi">
                        <label type="button" id="footer-text-color-dropdown" class="btn btn-link dropdown-toggle c7d" aria-haspopup="true" aria-expanded="false">Цвет <span class="color-picker-addon pull-right c5" id="footer-text-color-addon"><i class="block"></i></span></label>
                        <div class="dropdown-menu mt-35" aria-labelledby="footer-text-color-dropdown">
                            <?=$this->render('form/_colorpicker', [
                                'form'  => $form,
                                'model' => $model,
                                'field' => 'design_footer_text_color',
                                'addon' => '#footer-text-color-addon',
                            ]);?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="dropdown multi">
                <label type="button" id="caption-inner-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Заголовок внутренней страницы</label>
                <ul class="dropdown-menu pl15 pr15" aria-labelledby="caption-inner-dropdown">
                    <?=$this->render('form/_selectpicker', [
                        'form'  => $form,
                        'model' => $model,
                        'fonts' => $fonts,
                        'list'  => $listFonts,
                        'field' => 'design_caption_inner_font',
                        'style' => 'design_caption_inner_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designStyle,
                        'field' => 'design_caption_inner_style',
                        'label' => 'design_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designSize,
                        'field' => 'design_caption_inner_size',
                        'label' => 'design_size',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designCase,
                        'field' => 'design_caption_inner_case',
                        'label' => 'design_case',
                    ]);?>
                    <li class="dropdown multi">
                        <label type="button" id="caption-inner-color-dropdown" class="btn btn-link dropdown-toggle c7d" aria-haspopup="true" aria-expanded="false">Цвет <span class="color-picker-addon pull-right c5" id="caption-inner-color-addon"><i class="block"></i></span></label>
                        <div class="dropdown-menu mt-35" aria-labelledby="caption-inner-color-dropdown">
                            <?=$this->render('form/_colorpicker', [
                                'form'  => $form,
                                'model' => $model,
                                'field' => 'design_caption_inner_color',
                                'addon' => '#caption-inner-color-addon',
                            ]);?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="dropdown multi">
                <label type="button" id="text-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Обычный текст</label>
                <ul class="dropdown-menu pl15 pr15" aria-labelledby="text-dropdown">
                    <?=$this->render('form/_selectpicker', [
                        'form'  => $form,
                        'model' => $model,
                        'fonts' => $fonts,
                        'list'  => $listFonts,
                        'field' => 'design_text_font',
                        'style' => 'design_text_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designStyle,
                        'field' => 'design_text_style',
                        'label' => 'design_style',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designSize,
                        'field' => 'design_text_size',
                        'label' => 'design_size',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designCase,
                        'field' => 'design_text_case',
                        'label' => 'design_case',
                    ]);?>
                    <li class="dropdown multi">
                        <label type="button" id="text-color-dropdown" class="btn btn-link dropdown-toggle c7d" aria-haspopup="true" aria-expanded="false">Цвет <span class="color-picker-addon pull-right c5" id="text-color-addon"><i class="block"></i></span></label>
                        <div class="dropdown-menu mt-35" aria-labelledby="text-color-dropdown">
                            <?=$this->render('form/_colorpicker', [
                                'form'  => $form,
                                'model' => $model,
                                'field' => 'design_text_color',
                                'addon' => '#text-color-addon',
                            ]);?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <a href="#animation" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="grid-type">Анимация <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="animation">
        <div class="pl25px pr25px">
            <div class="dropdown multi">
                <label type="button" id="hover-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Наведение на проекты</label>
                <ul class="dropdown-menu pl15 pr15" aria-labelledby="hover-dropdown">
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designAnimStyle,
                        'field' => 'design_hover_style',
                        'label' => 'design_case',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designAnimSpeed,
                        'field' => 'design_hover_speed',
                        'label' => 'design_speed',
                    ]);?>
                </ul>
            </div>
            <div class="dropdown multi">
                <label type="button" id="jump-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Переход между страницами</label>
                <ul class="dropdown-menu pl15 pr15" aria-labelledby="jump-dropdown">
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designAnimStyle,
                        'field' => 'design_jump_style',
                        'label' => 'design_case',
                    ]);?>
                    <?=$this->render('form/_radioList', [
                        'form'  => $form,
                        'model' => $model,
                        'list'  => Site::$designAnimSpeed,
                        'field' => 'design_jump_speed',
                        'label' => 'design_speed',
                    ]);?>
                </ul>
            </div>
        </div>
    </div>
    <a href="#social" class="semibold collapse-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="grid-type">Социальные сети <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
    <div class="collapse in params" id="social">
        <div class="pl25px pr25px">
            <label type="button" id="hover-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Вконтакте</label>
            <label type="button" id="hover-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Facebook</label>
            <label type="button" id="hover-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Instagram</label>
            <label type="button" id="hover-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf" aria-haspopup="true" aria-expanded="false">Twitter</label>
            <label type="button" id="hover-dropdown" class="btn btn-link dropdown-toggle c8 hover-cf tk-pt-serif" aria-haspopup="true" aria-expanded="false">Pinterest</label>
            <div class="mt10 mb20px">
                <?=Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);?>
                <?=Html::a('Отмена', Url::toRoute('/profile/menu/index'), ['class' => 'btn btn-link cf back-menu'])?>
            </div>
        </div>
    </div>
<?ActiveForm::end();?>



