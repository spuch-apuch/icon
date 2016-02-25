<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property integer $id
 * @property integer $object_id
 * @property string $object_type
 * @property string $title
 * @property string $description
 * @property string $keywords
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['object_id'], 'integer'],
            [['object_type', 'title', 'description', 'keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_id' => 'Object ID',
            'object_type' => 'Object Type',
            'title'       => 'Тайтл',
            'description' => 'Дескрипшен',
            'keywords' => 'Keywords',
        ];
    }

    public static function getMeta($objectId, $objectType)
    {
        return self::find()
            ->where([
                'object_id'   => $objectId,
                'object_type' => $objectType,
            ])
            ->one();
    }

    public function setMeta($objectId, $objectType)
    {
        $this->object_id = $objectId;
        $this->object_type = $objectType;
        $this->save(false);
    }
}
