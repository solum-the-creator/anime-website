<?php use app\models\ListForm;

$this->registerCssFile("../css/anime.css",['rel'=>'stylesheet','depends'=>[app\assets\AppAsset::className()]]); ?>
<?php $this->registerJsFile("../js/commentScroll.js",['depends'=>[app\assets\AppAsset::className()]]); ?>

<div class="container">
    <div id="anime">
        <div class="row">
            <div class="col-md-5 box1">
                <div class="imgbox">
                    <img  src="<?= $anime->getImage(); ?>" width="350" class="poster-image">
                </div>

            </div>


            <div class="col-md-4 box2">

                <h1 class="anime-title" data-anime='idAnime'><?= $anime->Name ?></h1>

                <h5 style="color: #A7A7A7; font-weight:bold"><?= Yii::$app->formatter->asDate($anime->releaseDate, 'long') ?></h5>
                <h5 style="color: #5B5B5B; font-weight:bold; margin-top: -10px;"><?= $anime->category->title ?></h5>

                <ul class="list-group">
                    <li class="list-group-item active">
                        <strong>Оценка: </strong> <?= $anime->getAvgRating(); ?> <span class="smallRat">/ 5</span></li>
                    <li class="list-group-item active">
                        <strong>Тип: </strong> <?= $anime->type->title ?></li>
                    <li class="list-group-item active">
                        <strong>Длительность: </strong><?= $anime->duration ?> мин. ~ серия</li>
                    <li class="list-group-item active">
                        <strong>Рейтинг MPAA: <?= $anime->rating->title ?></li>
                    <li class="list-group-item active">
                        <strong>Первоисточник: </strong> Манга</li>
                </ul>


            </div>


            <div class="col-md-3 box4">
                <div class="formRating">
                    <p >Оцените аниме</p>
                    <?php $form2= \yii\widgets\ActiveForm::begin([
                        'action' => ['site/rating','id'=>$anime->idAnime],
                        'options' => ['class'=>'rating-area','role'=>'form']]); ?>
                    <div class="rating-area">
                    <?php $ratingForm->rating = 6-$rating->valueEvaluat; ?>
                    <?= $form2->field($ratingForm,'rating')->radioList(['1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5],['class'=>'rating-area','onchange' => 'document.getElementById("w0").submit()','item' => function($index, $label, $name, $checked,$value) {

                        $value=6-$value;
                        $check = $checked ? ' checked="checked"' : '';
                        $return = '<input type="radio" id="star-'.$index.'" name="' . $name . '" value="' .$value . '"'.$check.'>';

                        $return .= '<label class="modal-radio" for="star-'.$index.'">';
                        $return .= '</label>';


                        return $return;
                    }])->label(false); ?>
                    </div>
                    <?php \yii\widgets\ActiveForm::end(); ?>

                </div>
                <div class="box5">
                    <!-- <div class="boxButtns dropdown">
                    <button  class="btn-second dropbtn" onclick="myFunction()">Добавить в список&#160;&#160; &#709;</button>
                     <div id="myDropdown" class="dropdown-content">
                       <a href="#">Смотрю</a>
                       <a href="#">Отложено</a>
                       <a href="#">Просмотрено</a>
                       <a href="#">Брошено</a>
                       <a href="#">Пересматриваю</a>
                     </div> -->
                    <div class="select-wrapper ">

                        <?php $form3 = \yii\widgets\ActiveForm::begin([
                            'action' => ['site/list','id'=>$anime->idAnime],
                            'options' => ['role'=>'form'],
                        ]); ?>

                            <?php $userListForm->category = $categoryList->category; ?>
                            <?= $form3->field($userListForm, 'category')->dropDownList(ListForm::getCategoryList(),[
                                'prompt' => [
                                    'text' => 'Добавить в список',
                                    'options'=> ['value'=>'0','disabled' => true, 'selected' => true]
                                ],
                                'class' => 'selectListItem selectFilter',
                                'onchange' => 'document.getElementById("w1").submit()',
                            ])->label(false) ?>



                        <?php \yii\widgets\ActiveForm::end() ?>



                    </div>

                    <!-- </div> -->
                    <div class="boxButtns ">
                        <?php if(Yii::$app->user->isGuest): ?>
                        <a href="<?= yii\helpers\Url::to(['site/login']) ?>" class="btn-second buttnReview">Написать отзыв</a>
                        <?php else: ?>
                        <a href="#comment" class="btn-second buttnReview">Написать отзыв</a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>


        </div>
        <div class="row">
            <div class="col-md-12 box3">
                <h1 class="title-second">Описание</h1>
                <p><?= $anime->description ?> </p>
                <hr style="width: 80%;color: #222;">

            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="container main-review">
        <h1 class="title-second review-text">Рецензии и отзывы к аниме</h1>

        <div id="reviews">

            <?php if(!empty($comments)): ?>

            <?php foreach ($comments as $comment): ?>
                    <div class="row review">
                        <div class="col-md-2 box-review1">
                            <img src="<?= $comment->user->getImage(); ?>" alt="userImg" class="user-profile">
                        </div>
                        <div class="col-md-10 box-review2">
                            <h5><?= $comment->user->username; ?></h5>
                            <h5 class="dateAddedReview"><?= Yii::$app->formatter->asDate($comment->dateAdded, 'long') ?></h5>
                            <div class="content textReview">
                                <p style="color:#E8E8E8;"><?= $comment->textReview ?> </p>
                            </div>
                        </div>
                    </div>

            <?php endforeach; ?>

            <?php endif; ?>



        </div>
    </div>

</div>
<div class="container">

    <?php if(!Yii::$app->user->isGuest): ?>

    <?php $form = \yii\widgets\ActiveForm::begin([
            'action' => ['site/comment','id'=>$anime->idAnime],
            'options' => ['id'=>'reviewForm','role'=>'form']])?>


        <div class="row">
            <label for="comment">Комментарий</label>
        </div>
        <div class="row">
            <?= $form->field($commentsForm,'comment')->textarea(['placeholder'=>'Текст комментария','id'=>'comment'])->label("",['class'=>'labelComment']); ?>
        </div>
        <div class="row">
            <button type="submit">Отправить</button>
        </div>
    <?php \yii\widgets\ActiveForm::end(); ?>

    <?php endif; ?>

</div>



