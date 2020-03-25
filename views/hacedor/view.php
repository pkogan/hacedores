<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Hacedor */

$this->title = $model->idHacedor;
$this->params['breadcrumbs'][] = ['label' => 'Hacedors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hacedor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idHacedor], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->idHacedor], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idHacedor',
            'idUsuario',
            'institucion',
            'cantidadMaquinas',
            'materialImprimir',
            'link',
        ],
    ]) ?>
    
    <h3>Pedidos Asignados</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idAsignacion',
            'idPedido0.idSolicitante0.institucion',
            //'idHacedor',
            'cantidadAsignada',
            'cantidadCreada',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <h3>Modelos Creados</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idAsignacion',
            'idPedido0.idSolicitante0.institucion',
            //'idHacedor',
            'cantidadAsignada',
            'cantidadCreada',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
