<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Registro */

$this->title = 'Update Registro de ' . $model->apellidoNombre;
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
