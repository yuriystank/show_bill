<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Area */

$this->title = 'Update Area: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="area-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sort_count' => $sort_count
    ]) ?>

</div>
