<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Asignacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asignacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPedido')->textInput() ?>

    <?= $form->field($model, 'idHacedor')->textInput() ?>

    <?= $form->field($model, 'cantidadAsignada')->textInput() ?>

    <?= $form->field($model, 'cantidadCreada')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
