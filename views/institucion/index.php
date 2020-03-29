<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\InstitucionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instituciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institucion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Institución', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'rowOptions' => function ($model, $index, $widget, $grid) {

            return [
                'id' => $model['idInstitucion'],
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('institucion/view')
                . '&id="+(this.id);'
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idInstitucion',
            'nombre',
            //'logo',
            ['label' => 'Provincia', 'attribute' => 'provinciaFiltro', 'value' => 'idCiudad0.idProvincia0.provincia'],
            ['label' => 'Ciudad', 'attribute' => 'ciudadFiltro', 'value' => 'idCiudad0.ciudad'],
            ['label' => 'Productos Pedidos', 'value' => 'sumpedidos'],
            ['label' => 'Productos Entregados', 'value' =>'sumentregada']
            //'direccion',
            //'tel',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
