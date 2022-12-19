<?php

/* @var $this yii\web\View */
/* @var Anime $anime */

use yii\helpers\Url;

$this->title = 'HikimoriV2';
?>

<header>
    <div class="container body ">
        <center>
            <div class="inner-body ">
                <?php
                if(!Yii::$app->user->isGuest): ?>


                    <h1 class="title">Добро пожаловать,
                        <span style="color: #E7D8CC; text-transform:lowercase;"><?= Yii::$app->user->identity['username'] ?></span>
                    </h1>

                <?php else: ?>
                    <h1 class="title">Добро пожаловать на
                        <span style="color: #E7D8CC ">HikiMori</span>
                    </h1>
                <?php endif; ?>



                <p style="color: white" class="content">
                    Это сайт, на котором вы можете посмотреть информацию о своем любимом аниме. HikiMori
                    содержит подробную информацию по каждому выпущенному и не выпущенному аниме.
                    Вы можете отслеживать ваши любимое аниме в личном кабинете после регистрации.
                </p>
            </div>
            <div class="container">
                <?php if(!Yii::$app->user->isGuest): ?>

                        <a href="<?= \yii\helpers\Url::toRoute(['site/browse']) ?>" class="btn-main btn-main-primary">
                        Смотреть аниме
                        </a>

                <?php else: ?>
                    <a href="<?= \yii\helpers\Url::toRoute(['site/login']) ?>" class="btn-main btn-main-primary">
                        Вход
                    </a>
                    <a href="<?= \yii\helpers\Url::toRoute(['site/signup']) ?>" class="btn-main">
                        Регистрация
                    </a>
                <?php endif; ?>

            </div>

        </center>
    </div>
</header>


<div id="demo" class="carousel slide container" data-ride="carousel">
    <div class="ratedAnimeHead">
        <h1>Последние вышедшие аниме</h1>
    </div>
    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
        <li data-target="#demo" data-slide-to="3"></li>
        <li data-target="#demo" data-slide-to="4"></li>
    </ul>

    <div class="carousel-inner">
        <?php $ch = 0; ?>
        <?php for ($i=1;$i<3;$i++): ?>

            <div class="carousel-item <?php if ($i==1): ?>active<?php endif; ?>">

                <div class="row" id="topAnime<?= $i ?>">

                    <?php for ($j=0;$j<4;$j++): ?>
                        <div class="col-md-3 box">
                            <div class="animeBox">
                                <?= \yii\helpers\Html::img("{$anime[$ch]->getImage()}", ['alt' => 'Постер', 'width'=>'210', 'height'=>'350','class'=>'img']) ?>
                                <div class="browse-anime-bottom">
                                    <a href="<?= Url::toRoute(['site/view','id'=>$anime[$ch]->idAnime]); ?>"  class="browse-anime-title">
                                        <?= $anime[$ch]->Name ?>
                                    </a>
                                    <div class="browse-anime-year"><?= Yii::$app->formatter->asDate($anime[$ch]->releaseDate, 'long') ?></div>
                                    <div class="buttnMore">
                                        <a  href="<?= Url::toRoute(['site/view','id'=>$anime[$ch]->idAnime]); ?>" class="button" >Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $ch++; ?>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endfor; ?>

    </div>
    <!--<div class="carousel-item active">







        <div id="topAnime1" class="row">

            <div class="col-md-3 box">
                <div class="animeBox">
                    <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                    <div class="browse-anime-bottom">
                        <a href="#"  class="browse-anime-title">Токийский гуль</a>
                        <div class="browse-anime-year">2017</div>
                        <div class="buttnMore">
                            <a  href="#" class="button" >Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="carousel-item">

    </div>-->



    <!-- The slideshow -->
    <!-- <div class="carousel-inner">
        <div class="carousel-item active">
            <div id="topAnime1" class="row">
                <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>

            </div>
        </div>
        <div class="carousel-item">
            <div id="topAnime2" class="row">
                <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>

            </div>
        </div>
        <div class="carousel-item">
            <div id="topAnime2" class="row">
                <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 box">
                      <div class="animeBox">
                        <img src="image/animeImg/TokyoGhoul.jpg" alt="poster" width="210" height="350" class="img">
                        <div class="browse-anime-bottom">
                            <a href="#"  class="browse-anime-title">Токийский гуль</a>
                            <div class="browse-anime-year">2014</div>
                            <button type="submit" class="button" >Подробнее</button>
                        </div>
                        </div>
                    </div>

            </div>
        </div>

                </div> -->

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>

<div class="contactUs">
    <div class="container">

        <!-- row -->
        <div class="row">

            <div class="col-md-12  text-center1">

            </div>

        </div>
        <!-- /row -->

    </div>
</div>

