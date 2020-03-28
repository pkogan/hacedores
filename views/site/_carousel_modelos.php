<?php
use yii\helpers\Html;
use app\models\Modelo;
use yii\bootstrap\Carousel;

$modelos = Modelo::find()->all();

$items = [];
foreach ($modelos as $modelo){
    $items[] = [
        'content' => Html::img($modelo->imagen,
                             ['style' => 'height: 200px',
                              'class' => 'center-block']),
        'caption' => $modelo->nombre .
                  ' (' .
                  Html::a('Ver', ['modelo/view', 'id' => $modelo->idModelo]) .
                  ')',
    ];
}

echo Carousel::widget([
    'items' => $items,
    'showIndicators' => true,
    'controls' => [
        '<span class="glyphicon glyphicon-chevron-left"></span>',
        '<span class="glyphicon glyphicon-chevron-right"></span>'
    ],
]);
?>
