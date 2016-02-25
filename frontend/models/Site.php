<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "site".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $grid_type
 * @property string $grid_proportion
 * @property string $grid_size
 * @property string $grid_format
 * @property string $grid_position
 * @property integer $grid_distance
 * @property string $grid_caption
 * @property integer $grid_caption_desc
 * @property string $design_logo_text
 * @property string $design_logo_desc
 * @property string $design_logo
 * @property string $design_favicon
 * @property string design_bg_color
 * @property string design_bg_image
 * @property string design_bg_video
 * @property string design_menu_color
 * @property string design_footer_color
 * @property string design_logo_font
 * @property string design_logo_style
 * @property integer design_logo_size
 * @property string design_logo_case
 * @property string design_logo_color
 * @property string design_logo_desc_font
 * @property string design_logo_desc_style
 * @property integer design_logo_desc_size
 * @property string design_logo_desc_case
 * @property string design_logo_desc_color
 * @property string design_menu_item_font
 * @property string design_menu_item_style
 * @property integer design_menu_item_size
 * @property string design_menu_item_case
 * @property string design_menu_item_color
 * @property string design_item_caption_font
 * @property string design_item_caption_style
 * @property integer design_item_caption_size
 * @property string design_item_caption_case
 * @property string design_item_caption_color
 * @property string design_item_desc_font
 * @property string design_item_desc_style
 * @property integer design_item_desc_size
 * @property string design_item_desc_case
 * @property string design_item_desc_color
 * @property string design_footer_text_font
 * @property string design_footer_text_style
 * @property integer design_footer_text_size
 * @property string design_footer_text_case
 * @property string design_footer_text_color
 * @property string design_caption_inner_font
 * @property string design_caption_inner_style
 * @property integer design_caption_inner_size
 * @property string design_caption_inner_case
 * @property string design_caption_inner_color
 * @property string design_text_font
 * @property string design_text_style
 * @property integer design_text_size
 * @property string design_text_case
 * @property string design_text_color
 * @property string design_hover_style
 * @property integer design_hover_speed
 * @property string design_jump_style
 * @property integer design_jump_speed
 */
class Site extends \yii\db\ActiveRecord
{
    public $pageName;
    public static $gridType = [
        'type-tile'         => 'Плитка',
        'type-tile-room'    => 'Плитка совмещенная',
        'type-landing'      => 'Лендинг',
        'type-slider'       => 'Слайдер',
        'type-presentation' => 'Презентация',
    ];
    public static $gridProportion = [
        'proportion-equal'     => 'Равные',
        'proportion-tile'      => 'Плитка',
        'proportion-different' => 'Разная высота',
    ];
    public static $gridSize = [
        'size-large'   => 'Большой',
        'size-average' => 'Средний',
        'size-small'   => 'Малый',
    ];
    public static $gridFormat = [
        'format-vertical'   => 'Вытянут в высоту',
        'format-box'        => 'Квадрат',
        'format-horisontal' => 'Вытянут в ширину',
    ];
    public static $gridPosition = [
        'logo-top-left'     => 'Слева наверху',
        'logo-top-right'    => 'Справа наверху',
        'logo-top-center'   => 'В центре наверху',
        'logo-mobile'       => 'Мобильное меню',
        'logo-box-left'     => 'Слева наверху',
        'logo-box-right'    => 'Справа наверху',
        'logo-2line-center' => 'В центре наверху в две строки',
        'logo-2line-left'   => 'Слева наверху в две строки',
        'logo-2line-right'  => 'Справа наверху в две строки',
        'logo-fixed-left'   => 'Слева зафиксированно',
        'logo-fixed-right'  => 'Справа зафиксированно',
        'logo-bottom'       => 'Снизу',
    ];
    public static $gridDistance = [
        1  => 'Минимальное - 1px',
        10 => 'Маленькое - 10px',
        20 => 'Среднее - 20px',
        30 => 'Большое - 30px',
        40 => 'Огромное - 40px',
    ];
    public static $gridCaption = [
        'outside'      => 'Под изображением слева',
        'inside'       => 'Внутри изображения в центре',
        'inside-hover' => 'Внутри изображения при наведении',
    ];
    public static $size2int = [
        'type-tile' => [
            'size-large'   => 360,
            'size-average' => 300,
            'size-small'   => 240,
        ],
        'type-tile-room' => [
            'size-large'   => 375,
            'size-average' => 300,
            'size-small'   => 225,
        ],
    ];
    public static $designStyle = [
        'thin'             => 'Thin',
        'thin italic'      => 'Thin Italic',
        'light'            => 'Light',
        'light italic'     => 'Light Italic',
        'regular'          => 'Regular',
        'regular italic'   => 'Regular Italic',
        'semibold'         => 'Semibold',
        'semibold italic'  => 'Semibold Italic',
        'bold'             => 'Bold',
        'bold italic'      => 'Bold Italic',
        'extrabold'        => 'Extrabold',
        'extrabold italic' => 'Extrabold Italic',
        'black'            => 'Black',
        'black italic'     => 'Black Italic',
    ];
    public static $designSize = [
        6  => '6 px',
        8  => '8 px',
        10 => '10 px',
        12 => '12 px',
        14 => '14 px',
        16 => '16 px',
        18 => '18 px',
        22 => '22 px',
        26 => '26 px',
        30 => '30 px',
        34 => '34 px',
    ];
    public static $designCase = [
        'lowercase' => 'Строчные буквы',
        'uppercase' => 'ЗАГЛАВНЫЕ БУКВЫ',
    ];
    public static $designAnimStyle = [
        'resize' => 'Увеличение',
        'blur'   => 'Размытие',
        'shadow' => 'Затемнение',
    ];
    public static $designAnimSpeed = [
        '700' => 'Медленно',
        '300' => 'Быстро',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'description'], 'required'],
            [['user_id', 'status', 'grid_distance', 'grid_caption_desc', 'design_logo_size', 'design_logo_desc_size', 'design_menu_item_size', 'design_item_caption_size', 'design_item_desc_size', 'design_footer_text_size', 'design_caption_inner_size', 'design_text_size', 'design_hover_speed', 'design_jump_speed'], 'integer'],
            [['description', 'design_logo_desc'], 'string'],
            [['code', 'name', 'pageName', 'grid_type', 'grid_proportion', 'grid_size', 'grid_format', 'grid_position', 'grid_caption', 'design_logo_text', 'design_logo', 'design_favicon', 'design_bg_image', 'design_bg_video', 'design_logo_font', 'design_logo_style', 'design_logo_case', 'design_logo_desc_font', 'design_logo_desc_style', 'design_logo_desc_case', 'design_menu_item_font', 'design_menu_item_style', 'design_menu_item_case', 'design_item_caption_font', 'design_item_caption_style', 'design_item_caption_case', 'design_item_desc_font', 'design_item_desc_style', 'design_item_desc_case', 'design_footer_text_font', 'design_footer_text_style', 'design_footer_text_case', 'design_caption_inner_font', 'design_caption_inner_style', 'design_caption_inner_case', 'design_text_font', 'design_text_style', 'design_text_case', 'design_hover_style', 'design_jump_style'], 'string', 'max' => 255],
            [['design_bg_color', 'design_menu_color', 'design_footer_color', 'design_logo_color', 'design_logo_desc_color', 'design_menu_item_color', 'design_item_caption_color', 'design_item_desc_color', 'design_footer_text_color', 'design_caption_inner_color', 'design_text_color'], 'string', 'max' => 7],
            [['code'], 'unique'],
            [['design_logo', 'design_favicon', 'design_bg_color', 'design_bg_image', 'design_bg_video', 'design_menu_color', 'design_footer_color'], 'safe'],
            [['pageName'], 'required', 'on' => 'create'],
            [['code'], 'required', 'on' => 'edit'],
            [['grid_type', 'grid_proportion', 'grid_size', 'grid_format', 'grid_position', 'grid_distance', 'grid_caption'], 'required', 'on' => 'grid'],
            [['design_logo_text', 'design_logo_desc'], 'required', 'on' => 'design'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                  => 'ID',
            'user_id'             => 'Пользователь',
            'code'                => 'Ваш URL на Icon',
            'name'                => 'Название сайта',
            'pageName'            => 'Заголовок главной страницы',
            'description'         => 'Описание сайта',
            'grid_type'           => 'Тип сетки',
            'grid_proportion'     => 'Пропорции блоков',
            'grid_size'           => 'Размер блоков',
            'grid_format'         => 'Формат блоков',
            'grid_position'       => 'Расположение меню',
            'grid_distance'       => 'Расстояние между блоками',
            'grid_caption'        => 'Расположение заголовка',
            'grid_caption_desc'   => 'Добавить описание',
            'design_logo_text'    => 'Логотип',
            'design_logo_desc'    => 'Описание',
            'design_logo'         => 'Логотип',
            'design_favicon'      => 'Фавикон',
            'design_bg_color'     => 'Цвет фона сайта',
            'design_bg_image'     => 'Изображение фона сайта',
            'design_bg_video'     => 'Видео фона сайта',
            'design_menu_color'   => 'Цвет меню',
            'design_footer_color' => 'Цвет футера',
            'design_font'         => 'Шрифт',
            'design_style'        => 'Начертание',
            'design_size'         => 'Размер шрифта',
            'design_case'         => 'Стиль',
            'design_color'        => 'Цвет',
            'design_speed'        => 'Скорость',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        Yii::$app->session->remove('thisSite');
    }

    public static function getSite($request = false)
    {
        if ($request) {
            $testParams = Yii::$app->request->get('Site');
            if (is_array($testParams) && count($testParams)) {
                return $testParams;
            }
        }
        $thisSite = Yii::$app->session->get('thisSite');
        if (!$thisSite) {
            $sites = self::findAll(['user_id' => Yii::$app->user->id]);
            if (!count($sites)) {
                $thisSite = false; //Yii::$app->getResponse()->redirect(Url::toRoute('/profile/window/create-site'));
            } else {
                Yii::$app->session->set('thisSite', $sites[0]->attributes);
                $thisSite = $sites[0]->attributes;
            }
        }
        return $thisSite;
    }
}
