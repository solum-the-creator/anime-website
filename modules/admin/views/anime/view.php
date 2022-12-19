<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Anime */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Animes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="anime-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->idAnime], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Изображение', ['set-image', 'id' => $model->idAnime], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Категория', ['set-category', 'id' => $model->idAnime], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->idAnime], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить это аниме?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idAnime',
            'Name',
            'animeGenre',
            'dateAdded',
            'description',
            'duration',
            'releaseDate',
            'animeImage',
            'categoryId',
            'typeId',
            'ratingId',
        ],
    ]) ?>

</div>
