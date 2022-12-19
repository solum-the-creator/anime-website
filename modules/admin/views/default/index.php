<header>
    <div class="container body ">
        <center>
            <div class="inner-body ">
                <?php
                if(!Yii::$app->user->isGuest): ?>


                    <h1 class="title">Админ-панель</h1>

                <?php else: ?>
                    <h1 class="title">Добро пожаловать на
                        <span style="color: #E7D8CC ">HikiMori</span>
                    </h1>
                <?php endif; ?>



                <p style="color: white" class="content">
                    На данной странице вы можете выбрать категорию, в которой возможно добавление, редактирование и удаление
                    данных на сайте. Выберите категорию для изменения.
                </p>
            </div>
            <div class="container">



                    <a href="<?= \yii\helpers\Url::to(['/admin/anime/index']) ?>" class="btn-main btn-main-primary">
                        Аниме
                    </a>
                    <a href="<?= \yii\helpers\Url::toRoute(['/admin/category/index']) ?>" class="btn-main btn-main-primary">
                        Категории
                    </a>


            </div>

        </center>
    </div>
</header>
