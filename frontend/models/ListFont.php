<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "list_font".
 *
 * @property integer $id
 * @property string $name
 * @property string $css_class
 * @property string $script
 * @property string $style
 */
class ListFont extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list_font';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'css_class', 'script', 'style'], 'required'],
            [['name', 'css_class', 'script', 'style'], 'string', 'max' => 255],
            [['css_class'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'css_class' => 'Css Class',
            'script' => 'Script',
            'style' => 'Style',
        ];
    }

    public static function getFonts()
    {
        return self::find()->all();
    }

    public function getAttr()
    {
        return [
            'class'       => $this->css_class,
            'data-tokens' => Html::encode(strtolower($this->name)),
            'data-style'  => unserialize($this->style),
        ];
    }
}
