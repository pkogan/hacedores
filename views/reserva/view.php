<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Reserva */

if (!isset($can_edit)){
    $can_edit['editar'] = false;
    $can_edit['eliminar'] = false;
    $can_edit['recibir'] = false;
}

$this->title = 'Reserva Id: ' . $model->idReserva;
$this->params['breadcrumbs'][] = ['label' => 'Reservas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reserva-view">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?php
    if ($can_edit['editar']){
        echo Html::a('Editar', ['update', 'id' => $model->idReserva],
                    ['class' => 'btn btn-primary']);
        echo " ";
    }

    if ($can_edit['eliminar']){
        echo Html::a('Eliminar', ['delete', 'id' => $model->idReserva], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
        echo " ";
    }

    if ($can_edit['recibir']){
        if (!$model->recibido){
            echo Html::a('Recibido',
                        ['reserva/recibido', 'id' => $model->idReserva],
                        ['class' => 'btn btn-danger']);
        }else{
            echo Html::a('Recibido',
                        ['reserva/recibido', 'id' => $model->idReserva],
                        ['class' => 'btn btn-danger disabled']);
        }
    }
    ?>
  </p>

  <?php
  if ($model->recibido){
      echo Alert::widget([
          'options' => ['class' => 'alert-success'],
          'body' => 'Esta reserva ya fue recibida.',
      ]);
  }
  ?>

  <?= DetailView::widget([
      'model' => $model,
      'attributes' => [
          'idReserva',
          'idProducto',
          ['attribute' => 'producto.modelo.nombre',
           'label' => 'Nombre Producto'],
          'cantidad',
          'recibido:boolean',
          'usuario.nombreUsuario',
      ],
  ]) ?>


</div>
