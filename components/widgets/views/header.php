<header class="header">
    <div class="logo">
        <h1><a href="#"><img src="/img/logo.png" alt=""></a></h1>
    </div>
    <div class="user_info">
        <div class="user-img">
            <?php 
            ?>
            <img src="/main/file/show/<?= $nameImg ?>" alt="">
            <div class="user-id">
                <p><?= Yii::$app->user->identity->username ?></p>
                <span><?= Yii::$app->user->identity->email ?></span>
            </div>
        </div>

        <div class="button_panel">
            <a class="exit" href="/logout" data-method="post" id="logout"></a>
        </div>
    </div>
</header>