<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\widgets\AlertWidget;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>

<?php $this->beginBody() ?>
<div class="container">
    <header>
        <div class="header">
            <a href="/"><img src="img/logo-new.png" alt=""></a>
        </div>
    </header>


    <?= $content ?>
    <!--Footer-->
    <footer class="footer">
        <div class="wrap-footer">
            <span class="gray">&copy;</span> 2012 — 2013 ООО «Эволайн Плюс»
            <span class="number"><span class="gray">+375 (29)</span> 696-97-95 / <span class="gray">+375 (29)</span> 6-717-414</span>
            <span>Разработка сайта – <a href="reactive.by"><img src="img/reactive-new.png" alt=""></a></span>
        </div>
    </footer>
    <!--End Footer-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
