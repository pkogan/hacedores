<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = 'Pedido a '.$model->idInstitucion0->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pedido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idPedido], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idPedido], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idPedido',
            ['label'=>'Institución','value'=>$model->idInstitucion0->nombre],
            'idSolicitante0.nombreUsuario',
            'fecha',
            'observacion',
            //'imagen',
            ['label'=>'Modelo','value'=>$model->idModelo0->nombre],
            'cantidad',
            'idEstado0.estado',
        ],
    ]) ?>

</div>
