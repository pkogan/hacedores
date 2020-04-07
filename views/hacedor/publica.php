<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HacedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hacedores';
$this->params['breadcrumbs'][] = $this->title;

$btns = [
    'contact' => function ($url, $model, $key){
        return Html::a('<span class="glyphicon glyphicon-envelope" />',
                 ['hacedor/contact', 'id' => $model->idHacedor],
                 []);
    },
];
?>
<div class="hacedor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'apellidoNombre',
            'ciudad.nombre',

            ['class' => 'yii\grid\ActionColumn',
             'buttons' => $btns,
             'template' => '{contact}'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
