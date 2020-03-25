<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->user->identity->idRol == \app\models\Rol::ROL_ADMIN) {
            echo Html::a('Create Registro', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid) {

            return [
                'id' => $model['idRegistro'],
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('registro/view')
                . '&id="+(this.id);'
            ];
        },
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            //'idRegistro',
            //'marca',
            'apellidoNombre',
            'mail',
            
            'telefono',
            ['label' => 'Provincia', 'attribute' => 'provinciaFiltro', 'value' => 'idCiudad0.idProvincia0.provincia'],
            ['label' => 'Ciudad', 'attribute' => 'ciudadFiltro', 'value' => 'idCiudad0.ciudad'],

            //'Localidad',
            'impresores',
            'modelos',
            'tipoFilamento',
            //'stock',
            //'recursos',
            //'contacto',
            //'provincia',
            //'Comentario',
            //'impresoras',
            'PLA',
            'ABS',
            'PETG',
            'FLEX',
            'HIPS',
            //'ciudad',
            //'idCiudad',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

<?php Pjax::end(); ?>

</div>
