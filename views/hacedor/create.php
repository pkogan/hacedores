<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hacedor */

$this->title = 'Create Hacedor';
$this->params['breadcrumbs'][] = ['label' => 'Hacedors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hacedor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
