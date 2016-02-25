<?php
namespace app\components;

class MenuWidget extends \yii\base\Widget
{
    public $position;
    public $type;

    public function run()
    {
        $renderParams = [
            'position' => $this->position,
            'type'     => $this->type,
        ];
        return $this->render('MenuWidget', $renderParams);
    }
}
?>