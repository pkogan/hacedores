<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ModeloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Modelos';
$this->params['breadcrumbs'][] = $this->title;

if (!isset($can_edit)){
    $can_edit['create'] = false;
}
?>
<div class="modelo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      <?php
      if ($can_edit['create']){
          echo Html::a('Create Modelo', ['create'],
                      ['class' => 'btn btn-success']);
      }
      ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idModelo',
            'nombre',
            'descripcion:ntext',
            'hacedor.nombre',
            'imagen',
            //'link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
