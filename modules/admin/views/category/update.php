<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = 'Update Category: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->categoryId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update">

    <h1>Обновить категории</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
