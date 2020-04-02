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

  <?= $form->field($model, 'idInstitucion')->dropdownList(
      Institucion::find()
                 ->select(['nombre'])
                 ->indexBy('idInstitucion')
                 ->column()
  ,['prompt' => 'Seleccionar ...']) ?>

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
    <?php if(isset($model->idEntrega)) {
        echo Html::a('Eliminar', ['delete', 'id' => $model->idEntrega], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de eliminar la entrega?',
                'method' => 'post',
            ],
    ]);
           //echo '<a href="whatsapp://send?text=Entrega'.$model->idEntrega.' '.  \yii\helpers\Url::base('http') . '?r=entrega/view&id=' . $model->idEntrega .'">WS</a>';
    } ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
