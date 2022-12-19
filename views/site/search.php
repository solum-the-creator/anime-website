<?php use app\models\ListForm;
use yii\helpers\Url;

$this->registerCssFile("../css/search.css",['rel'=>'stylesheet','depends'=>[app\assets\AppAsset::className()]]); ?>


<div class="mm-slideout mm-page">
    <div class="container">
        <div class="row">
            <div class="content col-xl-12 p-4">
                <div class="titleSearch mb-4">
                    <h1 id="searchTitleResult">Поиск 	&#171; <?= $search ?> &#187;</h1>
                </div>

                <div class="formSearch p-2 mb-4">
                    <form class="form-inline searchBody" id="searchMainForm" method="get" action="<?= \yii\helpers\Url::to(['/site/search']) ?>">
                        <input class="form-control " type="search" id="inputSearch" placeholder="Поиск" name="search" aria-label="Search">
                        <button class="btn my-2 "  type="submit">Найти</button>
                    </form>
                </div>
                <div class="titleAnime mb-3">
                    <h2>Результат поиска</h2>
                    <hr style="width: 100%;color: #222;">
                </div>
                <div class="row" id="resultSearchAnimeBox">

                    <?php foreach ($resAnime as $anime): ?>
                        <div class="animes-grid-item col-md-3 p-4 mb-3">
                            <div class="imgAnimeBox mb-2">
                                <a href="<?= Url::toRoute(['site/view','id'=>$anime->idAnime]); ?>">
                                    <img src="<?= $anime->getImage(); ?>" alt="poster">
                                </a>
                            </div>
                            <div class="nameResultAnime">
                                <a href="<?= Url::toRoute(['site/view','id'=>$anime->idAnime]); ?>"><h3><?= $anime->Name ?></h3></a>
                            </div>
                            <div class="smallInfoAnime">
                                <h5><?= $anime->category->title; ?> / <?= Yii::$app->formatter->asDate($anime->releaseDate, 'php:Y') ?></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>





                </div>







            </div>
        </div>
    </div>
</div>