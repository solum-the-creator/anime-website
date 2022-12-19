<?php $this->registerCssFile("../css/userAcc.css",['rel'=>'stylesheet','depends'=>[app\assets\AppAsset::className()]]); ?>
<style>
    .headerImg{
        background-image: url('<?= Yii::$app->user->identity->getBackImage(); ?>');
    }
</style>

<div class="container-fluid mainContent" >
    <div class="row">
        <div class="col-md-8 userContainer mainPage" id="changingBox">

            <div class="headerImg" >
                <div class="row">
                    <div class="col-md-4 userImgButtn">
                        <?php $formBack = \yii\widgets\ActiveForm::begin([
                            'action' => ['site/updateback','id'=>Yii::$app->user->id],
                            'options' => ['role'=>'form']]); ?>
                        <?= $formBack->field($backimg,'image')->fileInput(['maxlength' => true,'class'=>'input-file','onchange' => 'document.getElementById("w0").submit()'])->label('Обновить обложку',['class'=>'btn btn-tertiary']); ?>



                        <?php $formBack = \yii\widgets\ActiveForm::end(); ?>


                        <img src="<?= Yii::$app->user->identity->getImage() ?>" id="userImageMain" style="width:100px; border-radius:50%;" alt="userImg">
                    </div>
                </div>

            </div>
            <div class="userInfo">
                <div class="row">
                    <div class="col-md-4">

                            <?php $formImg = \yii\widgets\ActiveForm::begin([
                                'action' => ['site/updateimg','id'=>Yii::$app->user->id],
                                'options' => ['role'=>'form']]); ?>
                            <?= $formImg->field($model,'image')->fileInput(['maxlength' => true,'id'=>'img1','class'=>'input-file','onchange' => 'document.getElementById("w1").submit()'])->label('Обновить аватарку',['class'=>'btn btn-tertiary']); ?>



                        <?php $formImg = \yii\widgets\ActiveForm::end(); ?>
                    </div>
                    <div class="col-md-8 fullUserInfo">
                        <h1><?= Yii::$app->user->identity->username; ?></h1>
                        <h5>На сайте с <?= Yii::$app->formatter->asDate(Yii::$app->user->identity->regDate, 'php:d.m.Y'); ?></h5>
                        <hr style="width: 100%;color: #222;">
                        <dl class="row">
                            <dt class="col-4">Имя:</dt>
                            <dd class="col-8"><?= Yii::$app->user->identity->Fullname; ?></dd>
                            <dt class="col-4">Почта:</dt>
                            <dd class="col-8"><?= Yii::$app->user->identity->Email; ?></dd>
                            <dt class="col-4">Статус аккаунта:</dt>
                            <dd class="col-8"><?= Yii::$app->user->identity->status; ?></dd>
                        </dl>
                    </div>
                    <hr style="width: 100%;color: #222;">
                </div>

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