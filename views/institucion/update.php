<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Institucion */

$this->title = 'Update Institucion: ' . $model->idInstitucion;
$this->params['breadcrumbs'][] = ['label' => 'Institucions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idInstitucion, 'url' => ['view', 'id' => $model->idInstitucion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="institucion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
