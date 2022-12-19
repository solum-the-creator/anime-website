<?php use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile("../css/browse.css",['rel'=>'stylesheet','depends'=>[app\assets\AppAsset::className()]]); ?>



<div class="container">
    <div class="row">
        <div class="col-md-8 animeList" >

            <h1>Список аниме</h1>
            <hr style="width: 100%;color: #222;">


            <div class="sortBy">
                <!--<div class="col-md-4">
                    <h5>Сортировать по:</h5>
                </div>-->

                <div class="col-md-6">

                        <?/*= \yii\helpers\Html::beginForm(); */?><!--
                        <?/*= \yii\helpers\Html::activeDropDownList($model,'sortId',
                            ['Дате добавления','Названию','Дате выхода'],[
                                    'onchange'=>'this.form.submit()',
                            ]); */?>
                        --><?/*= \yii\helpers\Html::endForm(); */?>
                        <?php $form = \yii\widgets\ActiveForm::begin(); ?>

                        <?= $form->field($model, 'str')->dropDownList(['0'=>'Дате добавления','1'=>'Названию','2'=>'Дате выхода'],[
                                'prompt' => '--',
                                'onchange' => 'this.form.submit()',
                        ])->label('Сортировать по:') ?>



                        <?php \yii\widgets\ActiveForm::end(); ?>

                        <!--<select class="sortBySelect">

                            <option selected value="dateAdded">Дате добавления</option>
                            <option value="rating">Рейтингу</option>
                            <option value="name">Названию</option>
                            <option value="dateRelease">Дате выхода</option>
                        </select>
                        <div class="select-arrow"></div>-->

                    </div>

                <hr style="width: 100%;color: #222;">




            </div>

            <?php \yii\widgets\Pjax::begin(['id' => 'sortPjax']) ?>
            <div id="animeSortedList">




                <?php foreach ($animes as $anime): ?>
                    <div class="animeCard">
                        <div class="row">
                            <div class=" col-md-3 cardImage">
                                <img src="<?= $anime->getImage(); ?>" alt="poster">
                            </div>
                            <div class="col-md-8 cardInfo" >
                                <h1><a href="<?= Url::toRoute(['site/view','id'=>$anime->idAnime]); ?>" class="animeName" data-anime="idAdnime"><?= $anime->Name ?></a></h1>
                                <h5><?= Yii::$app->formatter->asDate($anime->releaseDate, 'long') ?></h5>
                                <h5><?= $anime->category->title; ?></h5>
                                <div class="module">
                                    <p><?= $anime->description ?></p>
                                </div>

                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>

                <?php
                echo LinkPager::widget([
                    'pagination' => $pagination,
                ]);
                ?>

            </div>
            <?php \yii\widgets\Pjax::end(); ?>



        </div>
        <div class="col-md-3 filters">
            <div class="filterTitle">
                <h1><i class="fas fa-indent"></i>Фильтр</h1>
            </div>

            <div class="filterCategory">

                <?php $form2 = \yii\widgets\ActiveForm::begin(); ?>

                <?= $form2->field($model2, 'categoryStr')->dropDownList($categories,[
                    'prompt' => 'Выберите жанр',
                    'onchange' => 'this.form.submit()',
                ])->label('Жанры:') ?>

                <?= $form2->field($model2, 'typeStr')->dropDownList($types,[
                    'prompt' => 'Выберите тип',
                    'onchange' => 'this.form.submit()',
                ])->label('Тип аниме:') ?>

                <?= $form2->field($model2, 'ratingStr')->dropDownList($ratings,[
                    'prompt' => 'Выберите рейтинг',
                    'onchange' => 'this.form.submit()',
                ])->label('Возрастное ограничение:') ?>



                <?php \yii\widgets\ActiveForm::end(); ?>






            </div>
        </div>
    </div>
</div>