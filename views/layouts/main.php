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
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => Yii::t('app', 'Nav home'), 'url' => ['/main/default/index']],
                    ['label' => Yii::t('app', 'Nav contact'), 'url' => ['/main/contact']],
                    Yii::$app->user->isGuest ?
                            ['label' => Yii::t('app', 'Nav signup'), 'url' => ['/user/default/signup']] :
                            '',
                    !Yii::$app->user->isGuest ?
                            ['label' => Yii::t('app', 'User profile'), 'url' => ['/user/profile']] :
                            '',
                    Yii::$app->user->isGuest ?
                            ['label' => Yii::t('app', 'Nav login'), 'url' => ['/user/default/login']] : 
                            ['label' => Yii::t('app', 'Nav logout') . ' (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/user/default/logout'],
                        'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
<?= AlertWidget::widget() ?>
<?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
