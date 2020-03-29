<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (!isset($can_view)){
    $can_view['todos'] = false;
}

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      <?= Html::a('Agregar Producto',
                ['create'],
                ['class' => 'btn btn-success']) ?>
    </p>

    <?php if ($can_view['todos']){ ?>
      <div class="alert alert-warning">
        Rol admin: Puede ver todos los productos.
      </div>
    <?php } ?>
    
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'hacedor.nombre',
            'modelo.nombre',
            'cantidad',
            'stock',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
