<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EntregaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entregas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-index">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?php //echo Html::a('Registrar Entrega', ['create'],['class' => 'btn btn-success']) ?>
  </p>

  <?php
  if ($can_view['todos']){
      echo Alert::widget([
          'options' => ['class' => 'alert-warning'],
          'body' => 'Debido a su rol, puede ver todas las entregas',
      ]);
  }
  ?>
  
  <?php Pjax::begin(); ?>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'rowOptions' => function ($model, $index, $widget, $grid) {
          return [
              'id' => $model['idEntrega'],
              'onclick' => 'location.href="'
                      . Yii::$app->urlManager->createUrl('entrega/view')
                      . '&id="+(this.id);'
          ];
      },
      'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          
          'idEntrega',
          'fecha',
          ['attribute' => 'ciudad.ciudad',
           'label' => 'Ciudad'],
          ['attribute' => 'producto.hacedor.apellidoNombre',
           'label' => 'Maker'],
           ['attribute' => 'institucion.nombre',
           'label' => 'Institucion'],
                    'receptor',

          ['attribute' => 'producto.modelo.nombre',
           'label' => 'Nombre Modelo'],          
          'cantidad',
          ['attribute' => 'idEstado',
           'label' => 'Estado',
           'filter' => [
               '0' => 'En espera',
               '1' => 'Validado'
          ]],                


         // ['class' => 'yii\grid\ActionColumn'],
      ],
  ]); ?>

    <?php Pjax::end(); ?>

</div>
