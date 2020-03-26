<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Modelo */

if (!isset($can_edit)){
    $can_edit['editar'] = false;
    $can_edit['eliminar'] = false;
    $can_edit['reservar'] = false;
}

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="modelo-view">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?php if ($can_edit['editar']){ 
        echo Html::a('Editar', ['update', 'id' => $model->idModelo],
                    ['class' => 'btn btn-primary']);
        echo " ";
    }
    
    if ($can_edit['eliminar']){
        echo Html::a('Eliminar', ['delete', 'id' => $model->idModelo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
        echo " ";
    }
    
    if ($can_edit['reservar']){
        echo Html::a('Reservar', ['reserva/create',
                                 'id_modelo' => $model->idModelo],
                    ['class' => 'btn btn-default']);
    }
    ?>
  </p>

    <div class="row" >
      <div class="col-md-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idModelo',
                'nombre',
                'descripcion:ntext',
                'hacedor.nombre',
                'imagen',
                'link',
            ],
        ]) ?>
      </div>
      <div class="col-md-6">
        <?= Html::img($model->imagen,
        ['class' => 'img-responsive center-block img-thumbnail']);?>
      </div>
    </div>

    <?= Html::a('Descargar modelo',
              $model->link,
              ['class' => 'btn btn-default']);
    ?>

    <h1> Productos Realizados </h1>
    <div class="alert alert-warning">
      Cantidad disponible: <b><?= $model->getDisponible() ?></b>
    </div>
    
</div>
