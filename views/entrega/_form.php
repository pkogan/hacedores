<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Institucion;

/* @var $productos Array[app\models\Producto] */
/* @var $this yii\web\View */
/* @var $model app\models\Entrega */
/* @var $form yii\widgets\ActiveForm */

//$lst_productos = [];
//if (isset($productos)){
//    foreach ($productos as $prod){
//        $lst_productos[$prod->idProducto] =
//            $prod->short_string();
//    }
//}
?>

<div class="entrega-form">

  <?php $form = ActiveForm::begin(); ?>

  <?php // $form->field($model, 'idProducto')->dropdownList($lst_productos) ?>

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

        $options['data'] = yii\helpers\ArrayHelper::map(\app\models\Ciudad::find()->where("idProvincia in ($model->idProvincia) and categoria<>".'"ENTIDAD"')->orderBy('ciudad')->all(), 'idCiudad', 'ciudad');
        $optionsInstitucion['data'] = yii\helpers\ArrayHelper::map(\app\models\Institucion::find()->where("idCiudad in ($model->idCiudad) and idTipologia=10")->orderBy('nombre')->all(), 'idInstitucion', 'nombre');
        $optionsInstitucion['data'][2]='OTRO';
        $optionsInstitucion['data'][3]='CENTRO DE DISTRIBUCIÓN ZONAL';
    }
    

    echo $form->field($model, 'idProvincia')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->orderBy('provincia')->all(), 'idProvincia', 'provincia'), ['id' => 'idProvincia', 'prompt' => 'Seleccionar ...'])
    ?>

    <?=
    $form->field($model, 'idCiudad')->widget(\kartik\depdrop\DepDrop::classname(), $options)
    ?>   
    
  <p>Si la entrega se realiza a un Centro de distribución seleccionar Centro de Distribución Zonal</p>
  <?= $form->field($model, 'idInstitucion')->widget(\kartik\depdrop\DepDrop::classname(), $optionsInstitucion) ?>

  <?= $form->field($model, 'fecha')
         ->widget(
             DatePicker::className(),
             [
                 'options' => ['placeholder' => 'Fecha de entrega'],
                 'convertFormat' => true,
                 'pluginOptions' => [
                     'format' => 'dd/MM/yyyy',
                 ],
         ])
  ?>

  <?= $form->field($model, 'cantidad')->textInput() ?>
    <p>Detalle Nombre, Apellido, Cargo e Institución del Receptor de la Entrega</p>
    <?= $form->field($model, 'receptor')->textInput() ?>
  <?php
   echo $form->field($model, 'observacion')->textarea(['maxlength' => true])
  ?>

  <div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?> 
    <?php /* if(isset($model->idEntrega)) {
        echo Html::a('Eliminar', ['delete', 'id' => $model->idEntrega], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de eliminar la entrega?',
                'method' => 'post',
            ],
    ]);
           //echo '<a href="whatsapp://send?text=Entrega'.$model->idEntrega.' '.  \yii\helpers\Url::base('http') . '?r=entrega/view&id=' . $model->idEntrega .'">WS</a>';
    } */?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
