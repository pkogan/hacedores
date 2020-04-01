<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EntregaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entregas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      <?= Html::a('Registrar Entrega', ['create'],
                ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    if ($can_view['todos']){
        echo Alert::widget([
            'options' => ['class' => 'alert-warning'],
            'body' => 'Debido a su rol, puede ver todas las entregas',
        ]);
    }
    ?>
    
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'idEntrega',
            'fecha',
            'cantidad',
            'producto.modelo.nombre',
            ['attribute' => 'institucion.nombre',
             'label' => 'Entregado a'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
