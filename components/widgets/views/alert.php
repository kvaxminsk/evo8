<?php

if(\Yii::$app->getSession()->hasFlash('success'))
{
    echo \Yii::$app->getSession()->getFlash('success');
}
