<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\widgets\Alert;



AppAsset::register($this);
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>


<!--NavBar::begin([
    'brandLabel' => 'Hikirmori',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-sm',
    ],
]);
$menuItems = [
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Login', 'url' => '#', 'options' => ['data-toggle' => 'modal', 'data-target' => '#login-modal']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();-->


<nav class="navbar navbar-expand-sm">

    <a class="navbar-brand" href="<?= yii\helpers\Url::to(['/site/index']) ?>">
        <div class="row">
            <?= Html::img("@web/image/logoBlack.png",['alt'=>'Logo']) ?>
            <h1>Hikimori</h1>
        </div>

    </a>



    <form class="form-inline mx-auto" id="mainHeaderSearch" action="page/searchAnime.php" method="post">
        <input class="form-control mr-md-0" type="search" name="searchInputSet" id="mainHeaderInput" placeholder="??????????" aria-label="Search">
        <button class="btn my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
    </form>



    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link"  href="<?= \yii\helpers\Url::to(['/site/index']) ?>">??????????????</a>
        </li>

        <li class='nav-item dropdown dropleft'>
            <a class='nav-link' href='#' data-toggle='dropdown'>
                ??????????-????????????
            </a>
            <div class='dropdown-menu'>
                <a class='dropdown-item' style='color:#fff;' href='<?= \yii\helpers\Url::to(['/admin/anime/index']) ?>'>??????????</a>
                <a class='dropdown-item' style='color:#fff;' href='<?= \yii\helpers\Url::to(['/admin/category/index']) ?>'>??????????????????</a>
            </div>
        </li>


        <?php /*if (Yii::$app->user->isGuest):
            echo "<li class='nav-item'>".Html::a('??????????',['site/login'],['class'=>'nav-link'])."</li>";
            echo "<li class='nav-item'>".Html::a('??????????????????????',['site/signup'],['class'=>'nav-link'])."</li>";
        else: */?><!--
            <li class='nav-item dropdown dropleft'>
                <a class='nav-link' href='#' data-toggle='dropdown'>
                    <?/*=  Html::img("@web/image/".Yii::$app->user->identity['userImage'],['class'=>'userIcon','width'=>'60px','alt'=>'userImg']) */?>
                </a>
                <div class='dropdown-menu'>
                    <a class='dropdown-item disabled' style='color:silver; text-transform:lowercase;' href='#'>
                        <?/*=  Yii::$app->user->identity['username']*/?></a>
                    <a class='dropdown-item' style='color:#fff;' href='#'>??????????????</a>
                    <?/*= Html::a('??????????',['site/logout'],['class'=>'dropdown-item','color'=>'white']) */?>
                </div>
            </li>
        --><?php /* endif; */?>
        <?php /*if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'> <a class=\"nav-link\" href=\"#popup1\">??????????</a> </li>";
            echo "<li class='nav-item'> <a class=\"nav-link\" href=\"#popup2\">??????????????????????</a> </li>";
        }
        else{
            $username = $_SESSION['username'];
            $userImage = $_SESSION['userImage'];
            echo "<li class=\"nav-item dropdown dropleft\">
            	                <a class=\"nav-link\" href=\"#\" data-toggle=\"dropdown\">
            	                    <img src=\"image/$userImage\" style=\"width:50px; border-radius:50%;\" alt=\"logo \">
            	                </a>
            	                <div class=\"dropdown-menu\">
            	                    <a class=\"dropdown-item disabled\" style=\"color:silver; text-transform:lowercase;\" href=\"#\">
            	                    $username</a>
            	                    <a class=\"dropdown-item\" style=\"color:#fff;\" href=\"page/userAccount.php\">??????????????</a>

            	                    <a class=\"dropdown-item\" style=\"color:#fff;\" href=\"controller/logout.php\">??????????</a>
                </div>
            </li>";
        }
        */?>


    </ul>
</nav>


<!--<div id="popup1" class="popup-overlay">
    <div class="log-popup">
        <h2>????????</h2>
        <a class="close-window" href="#">&times;</a>
        <div class="log-content">
            <form action="../controller/login.php" method="post">
                <i class="fa fa-user icon"></i>
                <input type="text" placeholder="??????????" name="username" class="log-input" required>
                <br>
                <i class="fa fa-lock icon"></i>
                <input type="password" placeholder="????????????" name="password" class="log-input" required>
                <br>
                <input type="submit" value="??????????" name="signup-btn" class="btn-log">
            </form>
        </div>
    </div>
</div>

<div id="popup2" class="popup-overlay">
    <div class="log-popup">
        <h2>??????????????????????</h2>
        <a class="close-window" href="#">&times;</a>
        <div class="log-content">
            <form action="../controller/register.php" method="post">
                <i class="fa fa-user icon"></i>
                <input type="text" placeholder="?????????????? ??????" name="fullname" class="log-input" required>
                <br>
                <i class="fa fa-envelope icon"></i>
                <input type="email" placeholder="?????????????? ??????????" name="email" class="log-input" required>
                <br>
                <i class="fa fa-link icon"></i>
                <input type="text" placeholder="?????????????? ??????????" name="username" class="log-input" required>
                <br>
                <i class="fa fa-lock icon"></i>
                <input type="password" placeholder="?????????????? ????????????" name="password" class="log-input" required>
                <br>
                <input type="checkbox" name="chkbox" required> ?? ???????????????? ???? ?????????? ??????????????????
                <br>
                <input type="submit" value="????????????????????????????????????" name="signup-btn" class="btn-log">
            </form>
        </div>
    </div>
</div>
<div id="success" class="popup-overlay">
    <div class="log-popup">
        <h2>??????????????</h2>
        <a class="close-window" href="#">&times;</a>
        <div class="log-content">
            <p>?????????????? ???????????? ??????????????. ???????????? ???? ???????????? ?????????? ?? ???????? ??????????????.</p>
            <a href="#popup1" class="btn-main btn-main-primary">
                ????????
            </a>
        </div>
    </div>
</div>
<div id="error" class="popup-overlay">
    <div class="log-popup">
        <h2>????????????</h2>
        <a class="close-window" href="#">&times;</a>
        <div class="log-content">
            <p>???????????????? ?????????? ?????? ?????????? ?????? ????????????.</p>
        </div>
    </div>
</div>
<div id="error1" class="popup-overlay">
    <div class="log-popup">
        <h2>????????????</h2>
        <a class="close-window" href="#">&times;</a>
        <div class="log-content">
            <p>?????????????? ???? ????????????</p>
        </div>
    </div>
</div>-->


<?= $content ?>


<div class="footer">
    <p>&copy; Copyright Developed by Andrew Kostukevich.2021</p>
</div>









<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>


