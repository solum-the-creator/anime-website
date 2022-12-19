<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnimeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anime-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idAnime') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'animeGenre') ?>



    <?= $form->field($model, 'dateAdded') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'duration') ?>

    <?php // echo $form->field($model, 'ratingMPAA') ?>

    <?php // echo $form->field($model, 'releaseDate') ?>

    <?php // echo $form->field($model, 'animeImage') ?>

    <?php // echo $form->field($model, 'categoryId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
