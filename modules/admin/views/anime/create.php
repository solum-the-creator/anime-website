<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anime */

$this->title = 'Create Anime';
$this->params['breadcrumbs'][] = ['label' => 'Animes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anime-create">

    <h1>Добавление Аниме</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories'=>$categories,
        'types' => $types,
        'ratings' => $ratings,
    ]) ?>

</div>
