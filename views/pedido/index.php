<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Pedido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
                'rowOptions' => function ($model, $index, $widget, $grid) {

            return [
                'id' => $model['idPedido'],
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('pedido/view')
                . '&id="+(this.id);'
            ];
        },
 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idPedido',
            ['label'=>'Institucion','attribute'=>'institucionFilter','value'=>'idInstitucion0.nombre'],
            ['label'=>'Usuario','attribute'=>'usuarioFilter','value'=>'idSolicitante0.nombreUsuario'],
            'fecha',
            //'observacion',
            //'imagen',
            //'idModelo',
            'cantidad',
            ['label'=>'Estado','attribute'=>'estadoFilter','value'=>'idEstado0.estado'],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
