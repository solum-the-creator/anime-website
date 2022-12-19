<?php use yii\helpers\Url;

$this->registerCssFile("../css/userAcc.css",['rel'=>'stylesheet','depends'=>[app\assets\AppAsset::className()]]); ?>
<?php $this->registerCssFile("../css/myList.css",['rel'=>'stylesheet','depends'=>[app\assets\AppAsset::className()]]); ?>
<?php $this->registerCssFile("../css/adminPage.css",['rel'=>'stylesheet','depends'=>[app\assets\AppAsset::className()]]); ?>

<div class="container-fluid mainContent" >
    <div class="row">
        <div class="col-md-8 userContainer mainPage" id="changingBox">
            <div class="card-header w-100">
                <h1>Комментарии и отзывы</h1>
                <div class="listsInfo">

                </div>
            </div>
            <div class="tableContainer">
                <table class="table tebale-responsive2">
                    <thead>
                    <tr>
                        <th class="text-left border-top-0">№</th>

                        <th class="text-left border-top-0"></th>

                        <th class="text-left border-top-0 text-nowrap tdNameAnime">Название</th>

                        <th class="text-left border-top-0 text-nowrap">Комментарий</th>
                        <th class="text-left border-top-0 text-nowrap">Дата добавления</th>
                        <th class="text-left border-top-0"></th>

                    </tr>


                    </thead>
                    <tbody>

                    <?php
                    $i = 1;
                    foreach ($animes as $anime):
                    ?>
                        <tr>

                            <th class="text-left" ><?= $i ?></th>
                            <td class="text-center tdImage">
                                <a href="<?= Url::toRoute(['site/view','id'=>$anime->idAnime]); ?>"><img src="<?= $anime->anime->getImage(); ?>" alt="poster"></a>
                            </td>
                            <td class="text-left tdNameAnime">
                                <a href="<?= Url::toRoute(['site/view','id'=>$anime->idAnime]); ?>"><?= $anime->anime->Name; ?></a>
                            </td>

                            <td class="text-left table adminTd">
                                <?= $anime->textReview; ?>
                            </td>
                            <td class="text-left table adminTd">
                                <?= $anime->dateAdded; ?>
                            </td>


                            <td class="text-center table-100 adminTd" style="vertical-align: middle;">
                                <div >
                                    <a class="deleteButton" href="<?= Url::toRoute(['site/deletereview','id_review'=>$anime->idReview]); ?>">
                                        <i class="fas fa-trash-alt"  style="font-size: 24px;" ></i>
                                    </a>

                                </div>

                            </td>
                        </tr>
                    <?php
                    $i++;
                    endforeach;
                    ?>




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