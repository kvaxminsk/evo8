<?php
use yii\helpers\Html; 
use app\components\widgets\Header;

\app\assets\BaseAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <?= Html::csrfMetaTags() ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title) ?></title>
        <link href="/css/style1.css" rel="stylesheet">
        <link href="/css/custom.css" rel="stylesheet">
        <?php $this->head() ?>
    </head>
    <body>		
        <?php $this->beginBody() ?>
        <div id="container">

            <?= Header::widget() ?>

            <div class="main">

                <div class="aside">
                    <ul>
                        <li<?= isset(Yii::$app->view->params['leftMenu']) && $this->params['leftMenu'] == 1 ? ' class="active"' : '' ?>>
                            <a href="/manager/order"><i class="ic-new_order"></i>Заказы<span></span></a>
                        </li>
                        <li<?= isset(Yii::$app->view->params['leftMenu']) && $this->params['leftMenu'] == 2 ? ' class="active"' : '' ?>>
                            <a href="/manager/default/index"><i class="ic-profil"></i>Клиенты<span></span></a>
                        </li>
                        <li><a href="/manager/order/template"><i class="ic-templates"></i>Шаблоны</a></li>
                       <!-- <li ><a href="#"><i class="ic-new_order"></i>Новый заказ</a></li>
                        <li><a href="#"><i class="ic-archive"></i>Архив</a></li> -->
                        <li class="active"><a href="/manager/default/profile/<?= Yii::$app->user->getId() ?>"><i class="ic-profil"></i>Профиль</a></li>
                    </ul>
                </div>

                <div class="content">
                    <?= $content ?>
                </div>

                <div class="clear"></div>

                <footer class="footer">
                    <span>центр управления заказами</span>
                    <div class="nav-footer">
                        <a href="#">Помощь</a>
                        <a href="#">FAQ</a>
                        <a href="#">Правила пользования</a>
                        <a href="#">О компании</a>
                        <a href="#">Контакты</a>
                    </div>
                </footer>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>