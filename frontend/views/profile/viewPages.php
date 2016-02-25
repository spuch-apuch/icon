<?php
/* @var $this yii\web\View */

use yii\widgets\ListView;
?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView'     => '/layouts/_itemView/360.40.php',
]);?>
