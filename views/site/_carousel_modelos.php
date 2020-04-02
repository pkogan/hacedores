<?php
use yii\helpers\Html;
use app\models\Modelo;
use yii\bootstrap\Carousel;

$items = [];
$images = [
    '@web/img/index-carrousel/doctor-1.jpeg',
    '@web/img/index-carrousel/enfermera-1.jpeg',
    '@web/img/index-carrousel/impresora-1.jpeg',
    '@web/img/index-carrousel/mascaras-1.jpeg',
    '@web/img/index-carrousel/mascaras-2.jpeg',
    '@web/img/index-carrousel/mascaras-3.jpeg',
    '@web/img/index-carrousel/mascaras-4.jpeg',
];
foreach ($images as $image){
    $items[] = [
        'content' => Html::img($image,
                             ['style' => 'height: 400px',
                              'class' => 'center-block']),
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
