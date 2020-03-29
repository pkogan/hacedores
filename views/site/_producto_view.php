<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="producto row">
  <div class="col-md-4 text-left">
    <?= Html::encode($model->modelo->nombre) ?>
  </div>
  <div class="col-md-4">
    <?= Html::encode($model->stock) ?>
  </div>
  <div class="col-md-4">
    <div class="btn-group" role="group">
      <?= Html::a('Agregar',
                ['producto/create',
                 'Producto' => ['idModelo' => $model->idModelo,
                               'idHacedor' => $model->idHacedor]],
                ['class' => 'btn btn-small btn-success']);
      ?>
      <?= Html::a('Ver',
                ['producto/view',
                 'id' => $model->idProducto],
                ['class' => 'btn btn-small btn-default'])?>
    </div>
  </div>
</div>
