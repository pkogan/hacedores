<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Modelo;
use app\models\Hacedor;

if (!isset($can_edit)){
    $can_edit = [
        'idHacedor' => false,
    ];
}

/* @var $can_edit Array[string] => boolean */
/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

  <?php $form = ActiveForm::begin(); ?>

  <?php if ($can_edit['idHacedor']){ ?>
    <?= $form->field($model, 'idHacedor')->dropdownList(
        Hacedor::find()
               ->select(['apellidoNombre'])
               ->indexBy('idHacedor')
               ->column()
    )
    ->label('Hacedor (solo para admin)') ?>
  <?php }else{ ?>
    <?= $form->field($model, 'idHacedor')->hiddenInput()
           ->label(false) ?>
      <?php } ?>    

  <?= $form->field($model, 'idModelo')->dropdownList(
      Modelo::find()
            ->select(['nombre'])
            ->indexBy('idModelo')
            ->column()
  ) ?>

  <?= $form->field($model, 'cantidad')->textInput() ?>

  <div class="form-group">
    <?= Html::submitButton('Guardar',
                         ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
