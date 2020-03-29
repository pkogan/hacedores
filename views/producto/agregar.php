<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Agregar Producto Impreso';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-create">

    <h1><?= Html::encode($this->title) ?></h1>
<div class="producto-form">

  <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>


  <?= $form->field($model, 'idModelo')->dropdownList(
         app\models\Modelo::find()
            ->select(['nombre'])
            ->indexBy('idModelo')
            ->column()
  ) ?>

  <?= $form->field($model, 'cantidad')->textInput() ?>

  <div class="form-group">
    <?= Html::submitButton('Guardar',
                         ['class' => 'btn btn-success']) ?>
  </div>

  <?php \yii\bootstrap\ActiveForm::end(); ?>

</div>

</div>
