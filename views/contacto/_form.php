<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contacto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacto-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

  <?php
  $options = [
      'options' => ['id' => 'idCiudad', 'placeholder' => 'Seleccionar ...'],
      'id' => 'idCuidad',
      'pluginOptions' => [
          'depends' => ['idProvincia'],
          'url' => \yii\helpers\Url::to(['/ciudad/combo'])
  ]];
  
  $optionsInstitucion=[
      'options' => ['id' => 'idInstitucion', 'placeholder' => 'Seleccionar ...'],
      'id' => 'idInstitucion',
      'pluginOptions' => [
          'depends' => ['idProvincia','idCiudad'],
          'url' => \yii\helpers\Url::to(['/institucion/combo'])
  ]];

  if (!is_null($model->idCiudad)) {
      $model->idProvincia = $model->ciudad->idProvincia;

      $options['data'] = yii\helpers\ArrayHelper::map(
          \app\models\Ciudad::find()
                            ->where("idProvincia in ($model->idProvincia) " .
                                   "and categoria<>".'"ENTIDAD"')
                            ->orderBy('ciudad')
                            ->all(),
          'idCiudad', 'ciudad');
      
      $optionsInstitucion['data'] = yii\helpers\ArrayHelper::map(
          \app\models\Institucion::find()
                                 ->where("idCiudad in ($model->idCiudad) " .
                                        "and idTipologia=10")
                                 ->orderBy('nombre')
                                 ->all(),
          'idInstitucion', 'nombre');
      
      $optionsInstitucion['data'][2]='OTRO';
  }
  ?>

  <br/>
  <p>Indique la provincia, ciudad y la institución a la que pertenece o hace referencia.</p>
  <p>Si la institución no se encuentra, la opción "OTRO" se activará una vez seleccionada la provincia y ciudad. En dicho caso, aclare en el campo "Más Info" la institución al cual representa.</p>
  
  <?php 
  echo $form->field($model, 'idProvincia')
           ->dropDownList(
               yii\helpers\ArrayHelper::map(
                   \app\models\Provincia::find()->orderBy('provincia')->all(),
                   'idProvincia',
                   'provincia'),
               ['id' => 'idProvincia',
                'prompt' => 'Seleccionar ...'])
  ?>
  
  <?=
  $form->field($model, 'idCiudad')->widget(
      \kartik\depdrop\DepDrop::classname(), $options)
  ?>   

  <?= $form->field($model, 'idInstitucion')
         ->widget(\kartik\depdrop\DepDrop::classname(),
                 $optionsInstitucion) ?>

  <br/>
  <p>Indique si dicha institución posee un caso de COVID-19 confirmado.</p>
  <?= $form->field($model, 'con_caso')->checkbox() ?>

  <?= $form->field($model, 'mas_info')->textarea(['rows' => 6]) ?>

  <?= $form->field($model, 'captcha')
         ->widget(yii\captcha\Captcha::className()) ?>
  
  <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
