<?php
use yii\helpers\Html;

/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="row">
    <div class="col-lg-12">
        <h3><?= Yii::t('app', 'Список площадок')?></h3>
    </div>
</div>

<div class="row text-center">
    <?php if (!empty($dataProvider->getModels())) : ?>
        <?php $i = 0?>
        <?php foreach ($dataProvider->getModels() as $model) : ?>
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <?= Html::img(Yii::$app->params['uploadPath'].$model->image, ['class' => 'img-responsive'])?>
                    <div class="caption">
                        <h3><?=$model->title?></h3>
                        <p><?=$model->description?></p>
                        <p>
                            <?= Html::a(
                                Yii::t('app', 'Подробнее'),
                                ['area', 'id' => $model->id],
                                ['class' => 'btn btn-primary']
                            )?>
                        </p>
                    </div>
                </div>
            </div>
            <?php $i++?>
            <?php if ($i%4 == 0) : ?>
                </div><div class="row">
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?=Yii::t('app', 'Площадок пока нет...')?></p>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <?php echo \yii\widgets\LinkPager::widget([
            'pagination'=>$dataProvider->pagination,
        ]);?>
    </div>
</div>