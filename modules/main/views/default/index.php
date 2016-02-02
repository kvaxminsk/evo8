<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
<div class="main-default-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <?= var_dump(Yii::$app->user->getId()) ?>
<?php 
$auth = Yii::$app->authManager;

?>
            </div>
        </div>

    </div>
</div>
