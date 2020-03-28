<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Hacedor;

/* @var $this yii\web\View */
/* @var $model app\models\Modelo */
/* @var $form yii\widgets\ActiveForm */

if (!isset($can_edit)){
    $can_edit['idHacedor'] = false;
}
?>

<div class="modelo-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

  <?php
  if ($can_edit['idHacedor']){ 
      echo $form->field($model, 'idHacedor')->dropdownList(
          Hacedor::find()
                 ->join('LEFT JOIN', 'usuario',
                       'usuario.idUsuario = hacedor.idUsuario')
                 ->select(['usuario.nombreUsuario'])
                 ->indexBy('idHacedor')
                 ->column()
      );
  }else{
      echo $form->field($model, 'idHacedor')->hiddenInput()->label(false);
  }
  ?>

  <?= $form->field($model, 'imagen')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

  <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
