<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $shows array */
/* @var $areas array */
/* @var $model app\models\Event */

$this->title = 'Update Event: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'shows' => $shows,
        'areas' => $areas,
    ]) ?>

</div>