<?php
use yii\helpers\Html;
use app\models\Modelo;
use yii\bootstrap\Carousel;

$items = [];
$images = [
        '@web/img/index-carrousel/doctor.png',
    '@web/img/index-carrousel/modelo.png',
//    '@web/img/index-carrousel/impresora.jpeg',
    '@web/img/index-carrousel/impresoras.jpeg',
    '@web/img/index-carrousel/mascaras.png',

    '@web/img/index-carrousel/enfermera.png',
];
foreach ($images as $image){
    $items[] = [
        'content' => Html::img($image,
                             ['style' => 'height: 200px',
                              'class' => 'center-block'
                                 ]),
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