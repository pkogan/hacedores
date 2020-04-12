<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HacedorMensajeForm */
/* @var $form ActiveForm */
?>
<div class="hacedor-enviar_mensaje">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'nombre') ?>
  <?= $form->field($model, 'from_mail') ?>
  <?= $form->field($model, 'from_tel') ?>
  <?= $form->field($model, 'to_idHacedor')->hiddenInput()->label(false); ?>
  <?= $form->field($model, 'subject') ?>
  <?= $form->field($model, 'texto')->textArea() ?>

  <?= $form->field($model, 'captcha')
         ->widget(yii\captcha\Captcha::className())?>

  <div class="form-group">
    <?= Html::submitButton('<span class="glyphicon glyphicon-send" /> Enviar',
                         ['class' => 'btn btn-primary']) ?>
  </div>
  <?php ActiveForm::end(); ?>

</div><!-- hacedor-enviar_mensaje -->
