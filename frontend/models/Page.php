<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property integer $site_id
 * @property string $code
 * @property string $name
 * @property integer $parent_id
 * @property integer $main
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'code', 'name', 'parent_id', 'main'], 'required'],
            [['site_id', 'parent_id', 'main'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_id' => 'Сайт',
            'code' => 'Code',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'main' => 'Main',
        ];
    }

    public static function getPagesBySite($siteId)
    {
        return self::find()
            ->where(['site_id' => $siteId])
            ->orderBy('parent_id ASC')
            ->all();
    }
}
