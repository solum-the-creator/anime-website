<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Anime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anime-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true])->label('Название аниме') ?>

    <?= $form->field($model, 'animeGenre')->textInput(['maxlength' => true])->label('Жанры аниме') ?>



   <!-- --><?/*= $form->field($model, 'dateAdded')->textInput() */?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true,'style'=>['height'=>'200px']])->label('Описание') ?>

    <?= $form->field($model, 'duration')->textInput()->label('Длительность (мин.)') ?>



    <?= $form->field($model, 'releaseDate')->textInput()->label('Дата выхода') ?>

    <?/*= $form->field($model, 'animeImage')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'categoryId')->textInput() */?>



    <?= $form->field($model,'categoryId')->dropDownList($categories)->label('Жанр аниме') ?>
    <?= $form->field($model,'typeId')->dropDownList($types)->label('Тип аниме') ?>
    <?= $form->field($model,'ratingId')->dropDownList($ratings)->label('Возрастной рейтинг') ?>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
