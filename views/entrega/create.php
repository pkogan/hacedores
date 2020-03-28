<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Entrega */
/* @var $productos Array[Producto] */

$this->title = 'Create Entrega';
$this->params['breadcrumbs'][] = ['label' => 'Entregas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrega-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if ($error != null){
        echo Alert::widget([
            'options' => ['class' => 'alert-danger'],
            'body' => $error,
        ]);
    }
    ?>
    
    <?= $this->render('_form', [
        'model' => $model,
        'productos' => $productos,
    ]) ?>

</div>
