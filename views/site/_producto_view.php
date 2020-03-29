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
    <?= Html::a('Agregar',
              ['producto/create',
               'Producto' => ['idModelo' => $model->idModelo,
                             'idHacedor' => $model->idHacedor]],
              ['class' => 'btn btn-small btn-success']);
    ?>
  </div>
</div>
