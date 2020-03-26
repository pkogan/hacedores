<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Producto;
use app\models\Usuario;

/* @var $productos Arry[app\models\Producto] */
/* @var $this yii\web\View */
/* @var $model app\models\Reserva */
/* @var $form yii\widgets\ActiveForm */

if (!isset($can_edit)){
    $can_edit['idUsuario'] = false;
}
if (!isset($productos) || $productos == null){
    $productos = Producto::find()->all();
}

$lst_productos = [];
foreach ($productos as $prod){
    $lst_productos[$prod->idProducto] =
        $prod->hacedor->nombre . ":" .
        $prod->modelo->nombre . " (" .
        $prod->cantidad . ")";
}

?>

<div class="reserva-form">

  <?php $form = ActiveForm::begin(); ?>

  <p> Los siguientes son las producciones registradas. La notación es
    la siguiente: 
    <code>[Nombre_del_productor]:[Nombre_del_modelo]
([Cantidad_disponible])</code>
  </p>
  <?= $form->field($model, 'idProducto')->dropdownList(
      $lst_productos
  )->label('Producción') ?>

  <?php
  if ($can_edit['idUsuario']){
      echo $form->field($model, 'idUsuario')->dropdownList(
          Usuario::find()
                 ->select(['nombreUsuario'])
                 ->indexBy('idUsuario')
                 ->column()
      )->label('Id Usuario (Sólo visible para Admin)');
  }else{
      echo $form->field($model, 'idUsuario')->hiddenInput()->label(false);
  }
  ?>

  <?= $form->field($model, 'cantidad')->textInput(); ?>
  
  <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
