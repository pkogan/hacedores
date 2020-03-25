<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idRegistro') ?>

    <?= $form->field($model, 'marca') ?>

    <?= $form->field($model, 'mail') ?>

    <?= $form->field($model, 'apellidoNombre') ?>

    <?= $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'Localidad') ?>

    <?php // echo $form->field($model, 'impresores') ?>

    <?php // echo $form->field($model, 'modelos') ?>

    <?php // echo $form->field($model, 'tipoFilamento') ?>

    <?php // echo $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'recursos') ?>

    <?php // echo $form->field($model, 'contacto') ?>

    <?php // echo $form->field($model, 'provincia') ?>

    <?php // echo $form->field($model, 'Comentario') ?>

    <?php // echo $form->field($model, 'impresoras') ?>

    <?php // echo $form->field($model, 'PLA') ?>

    <?php // echo $form->field($model, 'ABS') ?>

    <?php // echo $form->field($model, 'PETG') ?>

    <?php // echo $form->field($model, 'FLEX') ?>

    <?php // echo $form->field($model, 'HIPS') ?>

    <?php // echo $form->field($model, 'ciudad') ?>

    <?php // echo $form->field($model, 'idCiudad') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
