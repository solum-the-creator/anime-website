<?php $this->registerCssFile("../css/login.css",['rel'=>'stylesheet','depends'=>[app\assets\AppAsset::className()]]); ?>
<?php
use yii\widgets\ActiveForm;
?>

<div class="container-fluid mainContent">
    <div class="row">
        <div class="col-md-4 userContainer mainPage " id="changingBox">
            <div class="card-header w-100">
                <h1>Вход</h1>

            </div>
            <div class="tableContainer">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <?= $form->field($login_model,'username')->textInput()->label('Логин') ?>
                </div>
                <div class="row">
                    <?= $form->field($login_model,'password')->passwordInput()->label('Пароль') ?>
                </div>
                <div class="row">
                    <button type="submit">Войти</button>
                </div>
                <?php $form = ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>








