<?php
namespace app\assets;

use yii\web\AssetBundle;
/**
 * Description of JQueryAsset
 *
 * @author mr
 */
class JQueryAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery/dist';
    public $js = [
        'jquery.min.js'
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
    ];
}
