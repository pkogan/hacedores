<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CiudadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ciudad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'categoria') ?>

    <?= $form->field($model, 'centroide_lat') ?>

    <?= $form->field($model, 'centroide_lon') ?>

    <?= $form->field($model, 'departamento_id') ?>

    <?= $form->field($model, 'departamento_nombre') ?>

    <?php // echo $form->field($model, 'fuente') ?>

    <?php // echo $form->field($model, 'idCiudad') ?>

    <?php // echo $form->field($model, 'localidad_censal_id') ?>

    <?php // echo $form->field($model, 'localidad_censal_nombre') ?>

    <?php // echo $form->field($model, 'municipio_id') ?>

    <?php // echo $form->field($model, 'municipio_nombre') ?>

    <?php // echo $form->field($model, 'ciudad') ?>

    <?php // echo $form->field($model, 'idProvincia') ?>

    <?php // echo $form->field($model, 'provincia_nombre') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
