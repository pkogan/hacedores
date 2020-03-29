<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<li class="producto list-group-item row md-y">
  <div class="col-xs-7">
      <b>Modelo <?= Html::encode($model->modelo->nombre) ?></b><br>
    <span class="badge"><?= Html::encode($model->cantidad) ?></span> Impresiones <br/>
    <span class="badge"><?= Html::encode($model->cant_entregas()) ?></span> Entregadas <br/>
    <span class="badge"><?= Html::encode($model->stock) ?></span> A entregar
  </div>
  <div class="col-xs-5">
    <div class="btn-group btn-danger" role="group">
      <?= Html::a('<span class="glyphicon glyphicon-edit"></span>Editar<br/>Producto',
                ['producto/update',
                 'id'=>$model->idProducto],
                ['class' => 'btn btn-small btn-success']);
      ?>
      <?= Html::a('<span class="glyphicon glyphicon-send"></span> Agregar<br/>Entrega',
                ['entrega/create',
                 'id' => $model->idProducto],
                ['class' => 'btn  btn-primary','tootip'=>'Agregar entrega',])?>
    </div>
  </div>
</li>
