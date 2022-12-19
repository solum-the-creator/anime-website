<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anime */

$this->title = 'Update Anime: ' . $model->Name;

?>
<div class="anime-update">

    <h1>Изменение информации "<?= $model->Name ?>"</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'types' => $types,
        'ratings' => $ratings,
    ]) ?>

</div>
