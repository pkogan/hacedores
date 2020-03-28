<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Institucion;

/* @var $productos Array[app\models\Producto] */
/* @var $this yii\web\View */
/* @var $model app\models\Entrega */
/* @var $form yii\widgets\ActiveForm */

$lst_productos = [];
if (isset($productos)){
    foreach ($productos as $prod){
        $lst_productos[$prod->idProducto] =
            $prod->short_string();
    }
}
?>

<div class="entrega-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'idProducto')->dropdownList($lst_productos) ?>

  <?= $form->field($model, 'idInstitucion')->dropdownList(
      Institucion::find()
                 ->select(['nombre'])
                 ->indexBy('idInstitucion')
                 ->column()
  ) ?>

  <?= $form->field($model, 'fecha')
         ->widget(
             DatePicker::className(),
             [
                 'options' => ['placeholder' => 'Fecha de entrega'],
                 'convertFormat' => true,
                 'pluginOptions' => [
                     'format' => 'dd/M/yyyy',
                 ],
         ])
  ?>

  <?= $form->field($model, 'cantidad')->textInput() ?>

  <?php
  // $form->field($model, 'imagen')->textInput(['maxlength' => true])
  ?>

  <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
