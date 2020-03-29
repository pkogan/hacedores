<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<li class="producto list-group-item row md-y">
  <div class="col-xs-8">
    <b><?= Html::encode($model->modelo->nombre) ?></b>
    <span class="badge"><?= Html::encode($model->stock) ?></span>
  </div>
  <div class="col-xs-4">
    <div class="btn-group" role="group">
      <?= Html::a('<span class="glyphicon glyphicon-plus" />',
                ['producto/create',
                 'Producto' => ['idModelo' => $model->idModelo,
                               'idHacedor' => $model->idHacedor]],
                ['class' => 'btn btn-small btn-success']);
      ?>
      <?= Html::a('<span class="glyphicon glyphicon-eye-open" />',
                ['producto/view',
                 'id' => $model->idProducto],
                ['class' => 'btn btn-small btn-default'])?>
    </div>
  </div>
</li>
