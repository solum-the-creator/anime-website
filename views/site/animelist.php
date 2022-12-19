<?php use yii\helpers\Url;

$this->registerCssFile("../css/userAcc.css",['rel'=>'stylesheet','depends'=>[app\assets\AppAsset::className()]]); ?>
<?php $this->registerCssFile("../css/myList.css",['rel'=>'stylesheet','depends'=>[app\assets\AppAsset::className()]]); ?>


<div class="container-fluid mainContent" >
    <div class="row">
        <div class="col-md-8 userContainer mainPage" id="changingBox">
            <div class="card-header w-100">
                <h1>Список аниме</h1>
                <div class="listsInfo">

                    <!-- <a href="#" class="cardLink">Смотрю <span class="countLink">2</span></a>
                    <a href="#" class="cardLink">Отложено <span class="countLink">1</span></a>
                    <a href="#" class="cardLink">Просмотрено <span class="countLink">2</span></a>
                    <a href="#" class="cardLink">Брошено <span class="countLink">0</span></a>
                    <a href="#" class="cardLink">Пересматриваю <span class="countLink">1</span></a> -->
                </div>
            </div>
            <div class="tableContainer">
                <table class="table table-responsive-2">
                    <thead>
                    <tr>
                        <th class="text-left border-top-0">№</th>

                        <th class="text-left border-top-0"></th>

                        <th class="text-left border-top-0 text-nowrap">Название</th>
                        <th class="text-left border-top-0 text-nowrap">В списке</th>
                        <th class="text-center border-top-0 text-nowrap">Оценка</th>
                        <th class="text-center border-top-0 text-nowrap">Тип</th>
                        <th class="text-center border-top-0 text-nowrap">Рейтиинг MPAA</th>
                    </tr>


                    </thead>
                    <tbody>

                    <?php
                    $i = 1;
                    foreach ($animes as $anime): ?>
                        <tr>
                            <th class="text-left" ><?= $i ?></th>
                            <td class="text-center tdImage">
                                <a href="<?= Url::toRoute(['site/view','id'=>$anime->idAnime]); ?>"><img src="<?= $anime->anime->getImage(); ?>" alt="poster"></a>
                            </td>
                            <td class="text-left table-100 tdNameAnime">
                                <a href="<?= Url::toRoute(['site/view','id'=>$anime->idAnime]); ?>"><?= $anime->anime->Name; ?></a>
                            </td>

                            <td class="text-left table-100">
                                <?= $anime->category; ?>

                            </td>
                            <td class="text-center table-100">
                                <?= $anime->anime->getUserRating(); ?>
                            </td>
                            <td class="text-center table-100">
                                <?= $anime->anime->type->title; ?>
                            </td>
                            <td class="text-center table-100">
                                <?= $anime->anime->rating->title ?>
                            </td>
                        </tr>
                    <?php
                    $i++;
                    endforeach; ?>




                    </tbody>
                </table>
            </div>


        </div>

        <div class="col-md-3 menuRight align-self-start">
            <div class="menuTitle">
                <h1>Меню</h1>
            </div>
            <div class="menuItems">
                <div class="menuItem">
                    <a href="<?= \yii\helpers\Url::to(['site/account']) ?>"><i class="fas fa-home"></i>Главная</a>
                </div>

                <div class="menuItem">
                    <a href="<?= \yii\helpers\Url::to(['site/animelist']) ?>"><i class="fas fa-tasks"></i>Список аниме</a>
                </div>



                <div class="menuItem">
                    <a href="<?= \yii\helpers\Url::to(['site/reviewlist']) ?>"><i class="fas fa-comments"></i>Мои Отзывы</a>
                </div>





            </div>
        </div>

    </div>

</div>